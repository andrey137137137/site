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

  public static function renderOutput($withPercent = false)
  {
    $title = $withPercent ? "С процентом" : "Без процента";
    $plotter = $withPercent ? "plotterWithPercent" : "plotterWithCourse";
    $list = $withPercent ? "resultListWithPercent" : "resultList";
    $listTitles = [
      "Плоттер",
      "Печать",
      "Печать, ламинация",
      "Печать, высечка",
      "Печать, ламинация, высечка",
    ];
    $listStyle = "padding-left: 0;";
  ?>

    <div class="col-md-6">
      <h3><?= $title ?></h3>
      <div class="row">
        <div class="col-md-6">
          <ol style="list-style-position: inside; <?= $listStyle ?>">
            <?php foreach ($listTitles as $value) { ?>
              <li> <?= $value ?>: </li>
            <?php } ?>
          </ol>
        </div>
        <div class="col-md-6">
          <ul style="list-style-type: none; <?= $listStyle ?>">
            <li> {{<?= $plotter ?>}} </li>
            <li v-for="item in <?= $list ?>"> {{item.value}} </li>
          </ul>
        </div>
      </div>
    </div>
<?php
  }
}
