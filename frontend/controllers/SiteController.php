<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Category;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
  private $categoryModel;
  private $categoriesModel;

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['logout', 'signup'],
        'rules' => [
          [
            'actions' => ['signup'],
            'allow' => true,
            'roles' => ['?'],
          ],
          [
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  /**
   * Displays homepage.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    return $this->getCategory(['is_main' => 1]);
  }

  public function actionCategory($id = false)
  {
    return $this->getCategory($id);
  }

  public function actionView($id = null)
  {
    return $this->getCategory($id);
  }

  private function getCategory($condition)
  {
    $this->loadCatModels($condition);
    $parents = [];

    if ($this->categoryModel) {
      $parentModel = $this->categoryModel;

      while ($parent = $parentModel->parent) {
        $parents[] = [
          'id' => $parent->id,
          'name' => $parent->name
        ];
        $parentModel = Category::findOne($parent->id);
      }

      $images = $this->categoryModel->images;
      $categories = $this->categoriesModel->select('*')->where(['parent_id' => $this->categoryModel->id]);
    } else {
      $images = null;
      $categories = $this->categoriesModel->select('*')->where(['parent_id' => null]);
    }

    $categories = $categories->all();

    $params = [
      'parents' => $parents,
      'categories' => $categories,
      'category' => $this->categoryModel,
      'images' => $images
    ];

    return $this->render(isset($condition['is_main']) ? 'index' : 'category', compact('params'));
  }

  /**
   * Displays contact page.
   *
   * @return mixed
   */
  public function actionContact()
  {
    return $this->render('contact');
  }

  /**
   * Displays calculator page.
   *
   * @return mixed
   */
  public function actionCalculator()
  {
    return $this->render('calculator');
  }

  /**
   * Finds the Image model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param string $id
   * @return Image the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  private function loadCatModels($condition = false)
  {
    if ($condition && ($this->categoryModel = Category::findOne($condition)) === null) {
      throw new NotFoundHttpException('The requested page does not exist.');
    }

    $this->categoriesModel = Category::find();
  }
}
