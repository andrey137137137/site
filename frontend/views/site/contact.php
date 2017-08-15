<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="wrap-image">
  <?= Html::img('/img/visit-card.png',
                    [
                        'alt' => 'Контакты',
                        // 'style' => 'width:15px;'
                    ]
                ) ?>
</div>

<div class="wrap-image">
  <?= Html::img('/img/visit-card2.png',
                    [
                        'alt' => 'Контакты 2',
                        // 'style' => 'width:15px;'
                    ]
                ) ?>
</div>
