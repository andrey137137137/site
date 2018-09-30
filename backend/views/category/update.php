<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Обновить альбом: ' . $params['model']->name;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $params['model']->name, 'url' => ['view', 'id' => $params['model']->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="category-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', compact('params')) ?>

</div>
