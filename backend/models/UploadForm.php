<?php

namespace backend\models;

use Yii;
// use yii\base\Model;
// use yii\web\UploadedFile;
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
  public $image;

  protected $imageConfig;
  protected $galleryPath;
  protected $newExt;
  protected $oldExt;

  private $imagePathes;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
    return [
      [['image'], 'image', 'extensions' => 'gif, jpg, jpeg, png'/*, 'skipOnEmpty' => false*/],
    ];
  }

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

  protected function updateImages($fromPath, $insert)
  {
    if ( ! $insert)
    {
      $this->deleteImages();
    }

    $this->setImagePathes();

    // Image::$driver = Image::DRIVER_GD2;

    foreach ($this->imagePathes as $key => $toPath)
    {
      $this->createImage($fromPath, $toPath, $this->imageConfig[$key]['w'], $this->imageConfig[$key]['h']);
    }
  }

  protected function deleteImages()
  {
    if (/* ! $this->curModelId && */ ! $this->oldExt)
    {
      return;
    }

    $this->setImagePathes(false);

    foreach ($this->imagePathes as $key => $path)
    {
      $this->deleteImage($path);
    }
  }

  protected function prepareImageConfig()
  {
    $this->galleryPath = Yii::getAlias('@gallery') . '/';

    foreach ($this->imageConfig as $key => $conf)
    {
      $this->imageConfig[$key]['path'] = $this->galleryPath . $conf['path'];
    }
  }

  private function createImage($fromPath, $toPath, $width, $height)
  {
    (new SimpleImage($fromPath))->best_fit($width, $height)->save($toPath, 100);
    // $this->fileModel->image->saveAs($toPath);

    // Image::thumbnail($fromPath, $width, $height, ManipulatorInterface::THUMBNAIL_INSET)->save($toPath, ['quality' => 100]);
  }

  private function deleteImage($path)
  {
    if (file_exists($path))
    {
      return unlink($path);
    }
  }

  private function setImagePathes($new = true)
  {
    $this->imagePathes = [];
    $ext = $new ? $this->newExt : $this->oldExt;

    foreach ($this->imageConfig as $key => $conf)
    {
      $this->imagePathes[$key] = $conf['path'] . $this->id . $ext;
    }
  }
}
