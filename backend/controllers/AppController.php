<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class AppController extends Controller
{
  protected $modelClass;
  protected $model;

  protected $curModelId;
  protected $defaultListValue = [];

  private $modelNamespace = 'backend\models';

  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
          'delete-multiple' => ['POST'],
        ],
      ],
      'access' => [
        'class' => AccessControl::className(),
        // 'only' => [],
        'rules' => [
          // разрешаем аутентифицированным пользователям
          [
            'allow' => true,
            'roles' => ['@'],
          ],
          // всё остальное по умолчанию запрещено
        ],
      ],
    ];
  }

// public function behaviors()
// {
//     return [
//         'access' => [
//             'class' => AccessControl::className(),
//             'only' => ['*'],
//             'rules' => [
//                 // разрешаем аутентифицированным пользователям
//                 [
//                     'allow' => true,
//                     'roles' => ['admin'],
//                 ],
//                 // всё остальное по умолчанию запрещено
//             ],
//         ],
//     ];
// }

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
   * Lists all Image models.
   * @return mixed
   */
  public function actionIndex()
  {
    $modelClass = $this->getModelClass();
    $dataProvider = new ActiveDataProvider(['query' => $modelClass::find()]);

    return $this->render('index', compact('dataProvider'));
  }

  /**
   * Displays a single Image model.
   * @param string $id
   * @return mixed
   */
  public function actionView($id)
  {
    return $this->render('view', ['model' => $this->findModel($id)]);
  }

  /**
   * Creates a new Image model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    return $this->change();
  }

  /**
   * Updates an existing Image model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param string $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $this->curModelId = $id;
    return $this->change();
  }

  /**
   * Deletes an existing Image model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param string $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    return $this->redirect(['index']);
  }

  public function actionDeleteMultiple()
  {
    $pk = Yii::$app->request->post('pk'); // Array of selected records primary keys

    // Preventing extra unnecessary query
    if (!$pk) {
      return;
    }

    $count = 0;

    $modelClass = $this->getModelClass();
    $models = $modelClass::findAll(['id' => $pk]);

    foreach ($models as $model) {
      if ($model->delete()) {
        $count++;
      }
    }

    return $count;
  }

  protected function additionalViewParams()
  {
    return [];
  }

  protected function getListQuery()
  {
    return [];
  }

  protected function getArray($list, $label, $value, $default = [])
  {
    $array = $default;

    foreach (ArrayHelper::map($list, $value, $label) as $key => $val)
    {
      $array[$key] = $val;
    }

    return $array;
  }

  private function change()
  {
    $modelClass = $this->getModelClass();
    $this->model = $this->curModelId ? $this->findModel($this->curModelId) : new $modelClass;

    if ($this->model->load(Yii::$app->request->post()))
    {
      switch ($this->modelClass)
      {
        case 'Category':
          $this->model->imageFiles = UploadedFile::getInstances($this->model, 'imageFiles');
        break;

        case 'Image':
          $this->model->imageFile = UploadedFile::getInstance($this->model, 'imageFile');
        break;
      }

      if ($this->model->save())
      {
        if ($this->curModelId)
        {
          $redirectParams = ['update', 'id' => $this->model->id];
        }
        else
        {
          $redirectParams = ['index'];
        }

        return $this->redirect($redirectParams);
      }
    }

    return $this->renderView();
  }

  private function renderView()
  {
    $params = [
      'model' => $this->model,
      'dropDownList' => $this->getArray($this->getListQuery(), 'name', 'id', $this->defaultListValue)
    ];

    foreach ($this->additionalViewParams() as $key => $value)
    {
      $params[$key] = $value;
    }

    return $this->render($this->curModelId ? 'update' : 'create', compact('params'));
  }

  /**
   * Finds the Image model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param string $id
   * @return Image the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  private function findModel($id)
  {
    $modelClass = $this->getModelClass();

    if (($model = $modelClass::findOne($id)) === null)
    {
      throw new NotFoundHttpException('The requested page does not exist.');
    }

    return $model;
  }

  private function getModelClass($className = false)
  {
    return $this->modelNamespace . '\\' . ( ! $className ? $this->modelClass : $className);
  }
}
