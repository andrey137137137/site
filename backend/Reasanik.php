<?php

namespace backend;

use yii\helpers\Html;

class Reasanik
{
  public static function beginFormRow()
  {
    return '<div class="form-group"><div class="row">';
  }

  public static function endFormRow()
  {
    return '</div></div>';
  }

  public static function beginFormGroup()
  {
    return '<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">';
  }

  public static function endFormGroup()
  {
    return '</div>';
  }

  public static function renderInput($title, $name, $max = false)
  {
    $inputOptions = [
      'class' => 'form-control',
      'v-model.number' => $name,
      'min' => 0
    ];

    if ($max !== false) {
      $inputOptions['max'] = $max;
    }

    echo Html::label($title . ':', $name, ['class' => 'form-label']);
    echo Html::input('number', $name, '', $inputOptions);
  }

  private static function _renderOutputItem($number, $title, $value, $attrs = [])
  {
?>
    <li class="col" <?= join(' ', $attrs) ?>>
      <div class="row row-no-gutters">
        <div class="col-xs-8 col-sm-7">
          <?= $number ?>. <?= $title ?>:
        </div>
        <div class="col-xs-4 col-sm-5">
          <?= $value ?>
        </div>
      </div>
    </li>
  <?php
  }

  public static function renderOutput($withPercent = false)
  {
    $title = $withPercent ? "С процентом" : "Без процента";
    $plotter = $withPercent ? "porWithPercent" : "porWithCourse";
    $list = $withPercent ? "calcListWithPercent" : "calcList";
    // $listStyle = "padding-left: 0;";
  ?>

    <div class="col-md-6">
      <h3><?= $title ?></h3>
      <!-- <ol class="row row-no-gutters" style="list-style-position: inside; ?= $listStyle ?>"> -->
      <ul class="list-unstyled row row-no-gutters">
        <?php
        self::_renderOutputItem(1, 'Плоттер', '{{' . $plotter . '}}');
        self::_renderOutputItem('{{index + 2}}', '{{item.title}}', '{{item.value}}', ['v-for="(item, index) in ' . $list . '"']);
        ?>
      </ul>
    </div>
<?php
  }
}
