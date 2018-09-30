<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Вы уверены, что хотите удалить это изображение?',
        'method' => 'post',
      ],
    ]) ?>
  </p>

  <?= DetailView::widget([
    'model' => $model,
    // 'condensed'=>true,
    // 'hover'=>true,
    // 'mode'=>DetailView::MODE_VIEW,
    // 'panel'=>[
    //     'heading'=>'Book # ' . $model->id,
    //     'type'=>DetailView::TYPE_INFO,
    // ],
    'attributes' => [
      'id',
      'name',
      'alias',
      [
        'label' => 'Изображение',
        'format' => 'raw',
        'value' => function($data)
        {
          return Html::img(
            Reasanik::$galleryPath
              . 'images/' . $data->id . '_'
              . $data->updated_at . '_'
              . $data->image_name,
            ['alt' => $data->name]
          );
        },
      ],
      'image_name',
      'description:ntext',
      'created_at',
      'updated_at',
      'meta_keys:ntext',
      'meta_desc:ntext',
      [
        'label' => 'Альбом',
        'value' => $model->cat->name
      ],
      // [
      //     'label' => 'cat_id',
      //     'value' => $model->cat->name,
      // ],
    ],
  ]) ?>

</div>
