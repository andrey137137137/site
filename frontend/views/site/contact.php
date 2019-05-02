<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

  <article class="contacts">
    <div class="container contacts-container">
      <h1 class="contacts-title"><?= Html::encode($this->title) ?></h1>

      <p class="contacts-desc">Анна Банникова</p>
      <p class="contacts-desc"><a href="mailto:anka24sp@gmail.com">anka24sp@gmail.com</a></p>
      <p class="contacts-desc">067 711 72 25</p>
    </div>
  </article>

</div>
