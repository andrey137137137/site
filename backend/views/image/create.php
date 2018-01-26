<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = 'Создать изображение';
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact('params')) ?>

</div>
