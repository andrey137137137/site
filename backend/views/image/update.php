<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = 'Обновить изображение: ' . $params['model']->name;
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $params['model']->name, 'url' => ['view', 'id' => $params['model']->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="image-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', compact('params')) ?>

</div>
