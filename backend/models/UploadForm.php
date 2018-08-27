<?php

namespace backend\models;

use Yii;
// use yii\base\Model;
// use yii\web\UploadedFile;
use yii\behaviors\SluggableBehavior;
use abeautifulsite\SimpleImage;
// use yii\imagine\Image;
// use Imagine\Image\ManipulatorInterface;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends \yii\db\ActiveRecord
{
  /**
   * @var UploadedFile file attribute
   */
  public $imageFile;

  protected $galleryPath;
  protected $imageParams;
  protected $names = ['new' => false, 'old' => false];

  private $imagePathes;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
      [['imageFile'], 'image', 'extensions' => 'gif, jpg, jpeg, png'/*, 'skipOnEmpty' => false*/],
    ];
  }

  // public function behaviors()
  // {
  //   return [
  //     [
  //       'class' => SluggableBehavior::className(),
  //       'attribute' => 'title',
  //       'slugAttribute' => 'alias',
  //     ],
  //   ];
  // }

  // public function behaviors()
  // {
  //   return [
  //     'alias' => [
  //       'class' => 'common\behaviors\Alias',
  //       'in_attribute' => 'title',
  //       'out_attribute' => 'alias',
  //       'translit' => true
  //     ]
  //   ];
  // }

  public function behaviors()
  {
    return [
      'slug' => [
        'class' => 'Zelenin\yii\behaviors\Slug',
        'slugAttribute' => 'alias',
        'attribute' => 'title',
        // optional params
        'ensureUnique' => true,
        'replacement' => '-',
        'lowercase' => true,
        'immutable' => false,
        // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general. 
        'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
      ]
    ];
  }

  protected function updateImages($insert)
  {
    $this->setGalleryPath();

    if (!$insert)
    {
      $this->deleteImages();
    }

    $this->createImages();
  }

  protected function deleteImages()
  {
    if (/* ! $this->curModelId && */ !$this->names['old'])
    {
      return;
    }

    $this->setImagePathes(false);

    foreach ($this->imagePathes as $path)
    {
      if (file_exists($path))
      {
        return unlink($path);
      }
    }
  }

  protected function setGalleryPath()
  {
    $this->galleryPath = Yii::getAlias('@gallery') . '/';

    foreach ($this->imageParams as $root => $params)
    {
      $this->imageParams[$root]['folder'] = $this->galleryPath . $params['folder'];
    }
  }

  private function createImages()
  {
    $this->setImagePathes();

    // Image::$driver = Image::DRIVER_GD2;

    foreach ($this->imageParams as $root => $params)
    {
      (new SimpleImage($this->imageFile->tempName))->
        best_fit($params['width'], $params['height'])->
        toFile($this->imagePathes[$root]);

      // Image::thumbnail(
      //   $this->imageFile->tempName,
      //   $params['width'],
      //   $params['height'],
      //   ManipulatorInterface::THUMBNAIL_INSET
      // )->
      //   save($this->imagePathes[$root], ['quality' => 100]);
    }

  }

  private function setImagePathes($new = true)
  {
    $this->imagePathes = [];
    $name = $new ? $this->names['new'] : $this->names['old'];

    foreach ($this->imageParams as $root => $params)
    {
      $this->imagePathes[$root] = $params['folder'] . $name;
    }
  }
}
