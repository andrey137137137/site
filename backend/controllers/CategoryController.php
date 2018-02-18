<?php

namespace backend\controllers;

use Yii;
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

    return [
      'parentsList' => $this->getArray($categories, 'title', 'id', [null => 'Нет родителя'])
    ];
  }

  protected function getListQuery()
  {
    return Image::find()->select(['id', 'title'])->where(['cat_id' => $this->curModelId])->orderBy('title')->asArray()->all();

    SELECT * FROM `rs_gallery_image` INNER JOIN `rs_gallery_category` ON `rs_gallery_image`.`cat_id` = `rs_gallery_category`.`id` INNER JOIN `rs_gallery_category` ON `rs_gallery_category`.`id` = `rs_gallery_category`.`parent_id` WHERE `rs_gallery_image`.`id` = 1;

    SELECT * FROM `rs_gallery_image` INNER JOIN `rs_gallery_category` ON `rs_gallery_image`.`cat_id` = `rs_gallery_category`.`id` WHERE `rs_gallery_image`.`cat_id` = 1 AND `rs_gallery_category`.`id` = `rs_gallery_category`.`parent_id`;
  }
}
