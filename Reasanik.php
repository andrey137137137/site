<?php

use yii\helpers\Html;

// namespace Reasanik;

class Reasanik
{
  public static $galleryPath = '/img/gallery/';
  public static $imageExtensions = ['gif', 'jpg', 'jpeg', 'png'];

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
