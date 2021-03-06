<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Вы уверены, что хотите удалить этот альбом?',
        'method' => 'post',
      ],
    ]) ?>
  </p>

  <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
      'id',
      'parent.name',
      // 'main_image_id',
      [
        'label' => 'Изображение',
        'format' => 'raw',
        'value' => function($data)
        {
          return Html::img(
            Reasanik::$galleryPath
              . 'categories/category_' . $data->id . '_'
              . $data->image_name,
            ['alt' => $data->name]
          );
        },
      ],
      'mainImage.image_name',
      'name',
      'alias',
      'description:ntext',
      'is_main'
    ],
  ]) ?>

</div>
