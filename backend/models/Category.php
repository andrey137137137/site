<?php

namespace backend\models;

// use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $main_image_id
 * @property string $title
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
    'category' => ['folder' => 'categories/', 'w' => 220, 'h' => 220]
  ];

  private $imagePath;
  private $oldMainImageId;

  private $changedMain = false;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
      return '{{%category}}';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['imageFiles'], 'image', 'extensions' => 'gif, jpg, jpeg, png'/*, 'skipOnEmpty' => false*/, 'maxFiles' => 20],
      [['title'], 'required'],
      // [['title'], 'unique'],
      [['parent_id', 'main_image_id', 'is_main'], 'integer'],
      ['is_main', function ($attribute, $params)
      {
        if ( ! $this->isNewRecord && $this->$attribute != $this->getOldAttribute('is_main'))
        {
          if ( ! $this->$attribute && ! count(Category::find()->where('is_main = 1 and id != :id', ['id' => $this->id])->all()) )
          {
            $this->addError($attribute, 'Хотя бы одна категория должна быть главной.');
          }
  
          $this->changedMain = true;
        }
      }],
      [['parent_id'], 'default', 'value' => null],
      [['description'], 'string'],
      [['title', 'alias'], 'string', 'max' => 255],
      [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
      [['main_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['main_image_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'id' => 'Идентификатор',
      'parent_id' => 'Родительская категория',
      'main_image_id' => 'Превью',
      'ext' => 'Расширение',
      'title' => 'Заголовок',
      'alias' => 'Алиас',
      'description' => 'Описание',
      'is_main' => 'На главную страницу',
    ];
  }

  public function beforeSave($insert)
  {
    if (parent::beforeSave($insert))
    {
      $this->oldMainImageId = $this->getOldAttribute('main_image_id');

      if ($this->oldMainImageId != $this->main_image_id)
      {
        $this->oldExt = Image::findOne($this->oldMainImageId)->ext;
        $this->newExt = $this->mainImage->ext;

        $this->prepareImageConfig();

        if ($this->main_image_id)
        {
          $this->imagePath = $this->galleryPath . 'images/' . $this->main_image_id . $this->newExt;
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

    foreach ($this->imageFiles as $image)
    {
      $imageModel = new Image;
      $imageModel->cat_id = $this->id;
      $imageModel->image = $image;
      $imageModel->save();
      $imageModel = null;
    }

    if ($this->imagePath && file_exists($this->imagePath) && ! is_dir($this->imagePath))
    {
      $this->updateImages($this->imagePath, $insert);
    }
    else
    {
      $this->deleteImages();
    }

    if ($this->changedMain && $this->is_main)
    {
      $catModels = Category::find()->where('is_main = 1 and id != :id', ['id' => $this->id])->all();

      foreach ($catModels as $catModel)
      {
        $catModel->is_main = 0;
        $catModel->save();
      }
    }
  }

  public function beforeDelete()
  {
    if (parent::beforeDelete()/* && ! $this->categories*/)
    {
      foreach ($this->categories as $category)
      {
        if ( ! $category->delete())
        {
          return false;
        }
      }

      $this->oldExt = $this->mainImage->ext;

      foreach ($this->images as $image)
      {
        if ( ! $image->delete())
        {
          return false;
        }
      }

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
