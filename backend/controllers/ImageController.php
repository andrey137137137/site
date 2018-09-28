<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\Image;
use yii\data\ActiveDataProvider;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends AppController
{
  protected $modelClass = 'Image';

  public function behaviors()
  {
    $behaviors = parent::behaviors();

    $behaviors['verbs']['actions']['delete-multiple'] = ['POST'];

    return $behaviors;
  }

  protected function getListQuery()
  {
    return Category::find()->select(['id', 'name'])->orderBy('name')->asArray()->all();
  }

  public function actionDeleteMultiple()
  {
      $pk = Yii::$app->request->post('pk'); // Array or selected records primary keys
  
      // Preventing extra unnecessary query
      if (!$pk) {
        return;
      }
  
      $count = 0;

      $images = Image::findAll(['id' => $pk]);

      foreach ($images as $image) {
        if ($image->delete()) {
          $count++;
        }
      }

      return $count;
  }
}
