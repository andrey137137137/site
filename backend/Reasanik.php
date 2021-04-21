<?php

namespace backend;

use yii\helpers\Html;

class Reasanik
{
  public static function beginFormGroup()
  {
    return '<div class="form-group"><div class="row">';
  }

  public static function endFormGroup()
  {
    return '</div></div>';
  }

  public static function renderInput($title, $name, $max = false)
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
}
