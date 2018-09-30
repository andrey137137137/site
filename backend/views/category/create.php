<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Создать альбом';
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', compact('params')) ?>

</div>
