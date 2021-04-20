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

  echo Html::label($title . ':', $name, ['class' => 'control-label']);
  echo Html::input('number', $name, '', $inputOptions);
}
?>

<?= Html::beginForm('', 'post', ['id' => 'calculator']) ?>

<div class="form-group">
  <?php
  rsRenderInput('Курс', 'course');
  rsRenderInput('Плёнка', 'membrane');
  rsRenderInput('Монтажка', 'montaging');
  rsRenderInput('Процент', 'percent', 100);
  rsRenderInput('Ширина', 'width');
  rsRenderInput('Высота', 'height');
  rsRenderInput('Рез', 'slicing');
  rsRenderInput('Порезка', 'cutting');
  rsRenderInput('Печать', 'printing');
  rsRenderInput('Ламинация', 'lamination');
  ?>
</div>

<div class="form-group">
  <p>{{quadrature}}</p>
</div>

<?= Html::endForm() ?>