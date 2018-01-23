<?php

namespace backend\models;

// use Yii;
// use abeautifulsite\SimpleImage;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property string $id
 * @property string $cat_id
 * @property string $title
 * @property string $ext
 * @property string $alias
 * @property string $description
 * @property string $meta_keys
 * @property string $meta_desc
 * @property string $create_at
 * @property string $update_at
 *
 * @property Category[] $categories
 * @property Category $cat
 */
class Image extends UploadForm
{
  protected $imageConfig = [
    // 'image' => ['path' => 'images/', 'w' => 908, 'h' => 672],
    'image' => ['path' => 'images/', 'w' => 900, 'h' => 664],
    // 'thumb' => ['path' => 'thumbs/', 'w' => 174, 'h' => 115]
    'thumb' => ['path' => 'thumbs/', 'w' => 174, 'h' => 119]
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
  public function rules()
  {
    $rules = parent::rules();

    $rules[] = [['cat_id'/*, 'ext'*/], 'required'];
    $rules[] = [['cat_id'/*, 'create_at', 'update_at'*/], 'integer'];
    // [['cat_id'], 'default', 'value' => 1];
    // [['create_at', 'update_at'], 'default', 'value' => 0];
    $rules[] = [['description', 'meta_keys', 'meta_desc'], 'string'];
    $rules[] = [['title'/*, 'ext'*/, 'alias'], 'string', 'max' => 255];
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
      'cat_id' => 'Категория',
      'title' => 'Заголовок',
      'ext' => 'Расширение',
      'alias' => 'Алиас',
      'description' => 'Описание',
      'meta_keys' => 'Meta Keys',
      'meta_desc' => 'Meta Desc',
      'create_at' => 'Дата создания',
      'update_at' => 'Дата обновления',
    ];
  }

  public function beforeSave($insert)
  {
    if (parent::beforeSave($insert))
    {
      if ($this->image)
      {
        $this->oldExt = $this->getOldAttribute('ext');

        if ( ! $this->title)
        {
          $ext = '.' . $this->image->extension;

          $nameLen = strlen($this->image->name);
          $extLen = strlen($ext);

          $this->title = substr($this->image->name, 0, $nameLen - $extLen);

          $this->ext = $ext;
        }

        $this->newExt = $this->ext;
        $this->imageValidated = true;
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

    if ($this->imageValidated)
    {
      $this->prepareImageConfig();
      $this->updateImages($this->image->tempName, $insert);
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()/* && ! $this->categories*/)
    {
      $this->oldExt = $this->ext;
      $this->prepareImageConfig();
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
