<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Image;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AppController
{
  protected $modelClass = 'Category';
  protected $curModelId;
  protected $defaultListValue = [null => 'Нет превью'];

  private $parentsList;
  private $childrenList = [];
  private $imagesList = [];

  // protected function change()
  // {
  //   $this->loadModel();

  //   $oldMainImageId = $this->dbModel->main_image_id;

  //   if ($this->dbModel->load(Yii::$app->request->post()) && $this->dbModel->save())
  //   {
  //     if ($this->dbModel->main_image_id)
  //     {
  //       $image = $this->galleryPath . 'images/' . $this->dbModel->main_image_id . '_' . $this->dbModel->mainImage->filename;

  //       if (file_exists($image))
  //       {
  //         $this->updateImages($image);
  //       }
  //     }
  //     else/*if ($oldMainImageId)*/
  //     {
  //       $this->deleteImages();
  //     }

  //     return $this->redirect(['update', 'id' => $this->dbModel->id]);
  //   }

  //   return $this->renderView();
  // }

  protected function additionalViewParams()
  {
    $categories = Category::find()->select(['id', 'title']);

    if ($this->curModelId)
    {
      $categories = $categories->where('(parent_id is null or parent_id != :id) and (id != :id)', ['id' => $this->curModelId]);
    }

    $categories = $categories->orderBy('title')->asArray()->all();

    $imagesList = [];

    foreach ($this->imagesList as $i => $array)
    {
      $imagesList[$array['id']] = [
        'data-imagesrc' => \Reasanik::$galleryPath . 'images/' . $array['id'] . $array['ext']];
    }

    // var_dump($imagesList);

    return [
      'parentsList' => $this->getArray($categories, 'title', 'id', [null => 'Нет родителя']),
      'imagesList' => $imagesList
    ];
  }

  protected function getListQuery()
  {
    $this->childrenList = [$this->curModelId];

    $this->setChildren($this->curModelId);

    $result = Image::find()->select(['id', 'title', 'ext'])->where(['cat_id' => $this->childrenList])->orderBy('title')->asArray()->all();

    $this->imagesList = $result;

    return $result;

    // SELECT * FROM `rs_gallery_image` INNER JOIN `rs_gallery_category` ON `rs_gallery_image`.`cat_id` = `rs_gallery_category`.`id` INNER JOIN `rs_gallery_category` ON `rs_gallery_category`.`id` = `rs_gallery_category`.`parent_id` WHERE `rs_gallery_image`.`id` = 1;

    // SELECT * FROM `rs_gallery_image` INNER JOIN `rs_gallery_category` ON `rs_gallery_image`.`cat_id` = `rs_gallery_category`.`id` WHERE `rs_gallery_image`.`cat_id` = 1 AND `rs_gallery_category`.`id` = `rs_gallery_category`.`parent_id`;
  }

  private function setChildren($curId)
  {
    if ($buffArray = Category::find()->select(['id', 'title'])->where(['parent_id' => $curId])->asArray()->all())
    {
      $buffArray = ArrayHelper::getColumn($buffArray, 'id');
      $this->childrenList = array_merge($this->childrenList, $buffArray);

      foreach ($buffArray as $i => $id)
      {
        $this->setChildren($id);
      }
    }
  }

}
