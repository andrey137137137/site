<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use yii\data\ActiveDataProvider;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends AppController
{
  protected $modelClass = 'Image';

  protected function getListQuery()
  {
    return Category::find()->select(['id', 'title'])->orderBy('title')->asArray()->all();
  }
}
