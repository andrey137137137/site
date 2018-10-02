<?php

namespace backend\models;

// use Yii;
// use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $main_image_id
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property integer $is_main
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Image $mainImage
 * @property Image[] $images
 */
class Category extends UploadForm
{
  public $imageFiles;

  protected $imageParams = [
    'category' => [
      'prefix' => 'category',
      'folder' => 'categories/',
      'width' => 220,
      'height' => 220
    ]
  ];

  private $imageOrigin = false;
  private $changedImage = false;
  private $deleteImage = false;
  private $changedMain = false;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
      return '{{%category}}';
  }

  // /**
  //  * @inheritdoc
  //  */
  // public function behaviors()
  // {
  //   return [
  //     TimestampBehavior::className(),
  //   ];
  // }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      ['imageFiles', 'image', 'extensions' => 'gif, jpg, jpeg, png'/*, 'skipOnEmpty' => false*/, 'maxFiles' => 20],
      ['name', 'required'],
      // [['name'], 'unique'],
      [['parent_id', 'main_image_id', 'is_main'], 'integer'],
      ['is_main', 'validateIsMain'],
      ['parent_id', 'default', 'value' => null],
      ['description', 'string'],
      [['name', 'alias'], 'string', 'max' => 255],
      ['parent_id', 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
      ['main_image_id', 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['main_image_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'Идентификатор',
      // 'image_name' => 'Расширение',
      'name' => 'Заголовок',
      'alias' => 'Алиас',
      'description' => 'Описание',
      'is_main' => 'На главную страницу',
      'created_at' => 'Дата создания',
      'updated_at' => 'Дата обновления',
      'parent_id' => 'Родительская категория',
      'main_image_id' => 'Превью',
    ];
  }

  public function validateIsMain($attribute, $params)
  {
    if ( ! $this->isNewRecord && $this->$attribute != $this->getOldAttribute('is_main'))
    {
      if ( ! $this->$attribute && ! count(Category::find()->where('is_main = 1 and id != :id', ['id' => $this->id])->all()) )
      {
        $this->addError($attribute, 'Хотя бы одна категория должна быть главной.');
      }

      $this->changedMain = true;
    }
  }

  public function beforeSave($insert)
  {
    if (parent::beforeSave($insert))
    {
      $oldMainImageId = $this->getOldAttribute('main_image_id');

      if ($this->main_image_id != $oldMainImageId)
      {
        // $this->names['old'] = Image::findOne($oldMainImageId)->image_name;
        $this->names['old'] = $this->image_name;

        if ($this->main_image_id)
        {
          // $this->names['new'] = $this->mainImage->image_name;

          $extPos = strrpos($this->mainImage->image_name, '.');
          $ext = substr($this->mainImage->image_name, $extPos + 1);
  
          $this->names['new'] = $this->getTranslitedName($this->name, $ext);

          $this->setGalleryPath();

          // $this->imageOrigin = $this->galleryPath . 'images/' . $this->mainImage->id . '_' . $this->names['new'];
          $this->imageOrigin = $this->galleryPath
            . 'images/' . $this->mainImage->id
            . '_' . $this->mainImage->updated_at . '_'
            . $this->mainImage->image_name;
        }
        else
        {
          $this->deleteImage = true;
        }
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

    if ($this->imageFiles)
    {
      foreach ($this->imageFiles as $image)
      {
        $imageModel = new Image;
        $imageModel->cat_id = $this->id;
        $imageModel->imageFile = $image;
        $imageModel->save();
        $imageModel = null;
      }
    }

    if ($this->imageOrigin && file_exists($this->imageOrigin) && !is_dir($this->imageOrigin))
    {
      $this->updateImages($this->imageOrigin, $insert);
      $this->image_name = $this->names['new'];
      $this->imageOrigin = null;
      $this->changedImage = true;
    }
    else if ($this->deleteImage)
    {
      $this->deleteImages();
      $this->image_name = null;
      $this->deleteImage = false;
      $this->changedImage = true;
    }

    if ($this->changedMain && $this->is_main)
    {
      $catModels = Category::find()->
        where('is_main = 1 and id != :id', ['id' => $this->id])->
        all();

      foreach ($catModels as $catModel)
      {
        $catModel->is_main = 0;
        $catModel->save();
      }
    }

    if ($this->changedImage)
    {
      $this->changedImage = false;
      $this->save();
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()/* && ! $this->categories*/)
    {
      foreach ($this->categories as $category)
      {
        if (!$category->delete())
        {
          return false;
        }
      }

      foreach ($this->images as $image)
      {
        if (!$image->delete())
        {
          return false;
        }
      }

      $this->names['old'] = $this->image_name;
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
  public function getParent()
  {
      return $this->hasOne(Category::className(), ['id' => 'parent_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getCategories()
  {
      return $this->hasMany(Category::className(), ['parent_id' => 'id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getMainImage()
  {
      return $this->hasOne(Image::className(), ['id' => 'main_image_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getImages()
  {
      return $this->hasMany(Image::className(), ['cat_id' => 'id']);
  }
}
