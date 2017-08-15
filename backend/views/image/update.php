<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = 'Update Image: ' . $params['model']->title;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $params['model']->title, 'url' => ['view', 'id' => $params['model']->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="image-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('params')) ?>

</div>
