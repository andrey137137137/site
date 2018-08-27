<?php

namespace backend\models;

// use Yii;
// use abeautifulsite\SimpleImage;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property string $image_name
 * @property string $description
 * @property string $meta_keys
 * @property string $meta_desc
 * @property string $create_at
 * @property string $update_at
 * @property string $cat_id
 *
 * @property Category[] $categories
 * @property Category $cat
 */
class Image extends UploadForm
{
  protected $imageParams = [
    // 'image' => ['folder' => 'images/', 'width' => 908, 'height' => 672],
    'image' => ['folder' => 'images/', 'width' => 900, 'height' => 664],
    // 'thumb' => ['folder' => 'thumbs/', 'width' => 174, 'height' => 115]
    'thumb' => ['folder' => 'thumbs/', 'width' => 174, 'height' => 119]
  ];

  private $imageValidated = false;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return '{{%image}}';
  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      TimestampBehavior::className(),
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    $rules = parent::rules();

    $rules[] = [['cat_id'/*, 'image_name'*/], 'required'];
    $rules[] = [['cat_id'/*, 'create_at', 'update_at'*/], 'integer'];
    // [['cat_id'], 'default', 'value' => 1];
    // [['create_at', 'update_at'], 'default', 'value' => 0];
    $rules[] = [['description', 'meta_keys', 'meta_desc'], 'string'];
    $rules[] = [['name'/*, 'image_name'*/, 'alias'], 'string', 'max' => 255];
    $rules[] = [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']];

    return $rules;
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'Идентификатор',
      'name' => 'Заголовок',
      'alias' => 'Алиас',
      'image_name' => 'Расширение',
      'description' => 'Описание',
      'meta_keys' => 'Meta Keys',
      'meta_desc' => 'Meta Desc',
      'create_at' => 'Дата создания',
      'update_at' => 'Дата обновления',
      'cat_id' => 'Категория',
    ];
  }

  public function beforeSave($insert)
  {
    if (parent::beforeSave($insert))
    {
      if ($this->imageFile && !$this->name)
      {
        $nameLen = strlen($this->imageFile->name);
        $extLen = strlen($this->imageFile->extension);

        $this->name = substr($this->imageFile->name, 0, $nameLen - $extLen);
      }

      return true;
    }
    else
    {
      return false;
    }
  }

  public function afterSave($insert, $changedAttributes)
  {
    parent::afterSave($insert, $changedAttributes);

    if ($this->imageFile)
    {
      $this->names['old'] = $this->getOldAttribute('image_name');

      // $translit = (new Translit())->translit($this->imageFile->name, true, 'ru-en');

      // $this->names['new'] = $this->id . '_' . $translit;
      $this->names['new'] = $this->id . '_' . $this->imageFile->name;
      $this->updateImages($insert);

      $this->image_name = $this->names['new'];
      $this->imageFile = null;
      $this->save();
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()/* && ! $this->categories*/)
    {
      $this->names['old'] = $this->image_name;
      $this->setGalleryPath();
      $this->deleteImages();
      return true;
    }
    else
    {
      return false;
    }
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCategories()
  {
    return $this->hasMany(Category::className(), ['main_image_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCat()
  {
    return $this->hasOne(Category::className(), ['id' => 'cat_id']);
  }
}
