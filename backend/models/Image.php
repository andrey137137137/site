<?php

namespace backend\models;

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
    'image' => [
      'prefix' => false,
      'folder' => 'images/',
      'width' => 900,
      'height' => 664
    ],
    // 'thumb' => ['folder' => 'thumbs/', 'width' => 174, 'height' => 115]
    'thumb' => [
      'prefix' => 'thumb',
      'folder' => 'thumbs/',
      'width' => 174,
      'height' => 119
    ]
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

    $rules[] = [['cat_id'/*, 'image_name'*/], 'required'];
    $rules[] = [['cat_id'/*, 'created_at', 'updated_at'*/], 'integer'];
    // [['cat_id'], 'default', 'value' => 1];
    // [['created_at', 'updated_at'], 'default', 'value' => 0];
    $rules[] = [['description', 'meta_keys', 'meta_desc'], 'string'];
    $rules[] = [['name'/*, 'image_name'*/, 'alias'], 'string', 'max' => 255];
    $rules[] = [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']];
    $rules[] = ['name', 'validateName', 'skipOnEmpty' => false];
    // $rules[] = ['name', 'validateName', 'when' => function ($model) {
    //     return $model->imageFile;
    //   }, 'skipOnEmpty' => false];

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
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата обновления',
      'cat_id' => 'Категория',
    ];
  }

  public function validateName($attribute, $params)
  {
    if (!$this->$attribute)
    {
      if ($this->imageFile)
      {
        $nameLen = strlen($this->imageFile->name);
        $extLen = strlen($this->imageFile->extension) + 1;
  
        $this->$attribute = substr($this->imageFile->name, 0, $nameLen - $extLen);
      }
      else
      {
        $this->addError($attribute, 'Название изображения не должно быть пустым');
      }
    }
  }

  public function afterSave($insert, $changedAttributes)
  {
    parent::afterSave($insert, $changedAttributes);

    if ($this->imageFile)
    {
      $this->names['old'] = $this->getOldAttribute('image_name');

      // $this->names['new'] = (new Translit())->translit($this->name, true, 'ru-en') .
      //   '.' . $this->imageFile->extension;

      $this->names['new'] = $this->getTranslitedName(
        $this->name,
        $this->imageFile->extension
      );

      $this->updateImages($this->imageFile->tempName, $insert);

      $this->image_name = $this->names['new'];

      if (!$insert && $this->imageFile)
      {
        $this->deleteOldCatPrevious();
      }

      $this->imageFile = null;
      $this->save();
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()/* && ! $this->categories*/)
    {
      $this->names['old'] = $this->image_name;
      $this->deleteImages();

      $this->deleteOldCatPrevious();

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

  private function deleteOldCatPrevious()
  {
    $categories = Category::findAll(['main_image_id' => $this->id]);

    foreach ($categories as $category)
    {
      $category->main_image_id = null;
      $category->save();
      $category->main_image_id = $this->id;
      $category->save();
    }
  }
}
