<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

function rsRenderInput($title, $name, $max = false)
{
  $inputOptions = [
    'class' => 'form-control',
    'v-model' => $name,
    'min' => 0
  ];

  if ($max !== false) {
    $inputOptions['max'] = $max;
  }
?>
  <div class="col-md-2">
    <?= Html::label($title . ':', $name, ['class' => 'form-label']) ?>
    <?= Html::input('number', $name, '', $inputOptions) ?>
  </div>
<?php
}
?>
<div class="row">
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
  <div class="col-md-1">.col-md-1</div>
</div>
<div class="row">
  <div class="col-md-8">.col-md-8</div>
  <div class="col-md-4">.col-md-4</div>
</div>
<div class="row">
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
  <div class="col-md-4">.col-md-4</div>
</div>
<div class="row">
  <div class="col-md-6">.col-md-6</div>
  <div class="col-md-6">.col-md-6</div>
</div>

<?= Html::beginForm('', 'post', ['id' => 'calculator']) ?>

<h2>ВВОД</h2>

<div class="form-group">
  <div class="row">
    <?php
    rsRenderInput('Курс', 'course');
    rsRenderInput('Плёнка', 'membrane');
    ?>
    <?php
    rsRenderInput('Монтажка', 'montaging');
    rsRenderInput('Процент', 'percent', 100);
    ?>
    <?php
    rsRenderInput('Ширина', 'width');
    rsRenderInput('Высота', 'height');
    ?>
    <?php
    rsRenderInput('Рез', 'slicing');
    rsRenderInput('Порезка', 'cutting');
    ?>
    <?php
    rsRenderInput('Печать', 'printing');
    rsRenderInput('Ламинация', 'lamination');
    ?>
  </div>
</div>

<h2>ВЫВОД</h2>

<div class="form-group">
  <div class="row">
    <?php
    rsRenderInput('Курс', 'course');
    rsRenderInput('Плёнка', 'membrane');
    ?>
    <?php
    rsRenderInput('Монтажка', 'montaging');
    rsRenderInput('Процент', 'percent', 100);
    ?>
    <?php
    rsRenderInput('Ширина', 'width');
    rsRenderInput('Высота', 'height');
    ?>
    <?php
    rsRenderInput('Рез', 'slicing');
    rsRenderInput('Порезка', 'cutting');
    ?>
    <?php
    rsRenderInput('Печать', 'printing');
    rsRenderInput('Ламинация', 'lamination');
    ?>
  </div>
</div>

<?= Html::endForm() ?>