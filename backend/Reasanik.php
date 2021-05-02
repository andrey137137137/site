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

  public static function renderOutput($withPercent = false)
  {
    $title = $withPercent ? "С процентом" : "Без процента";
    $plotter = $withPercent ? "porWithPercent" : "porWithCourse";
    $list = $withPercent ? "calcListWithPercent" : "calcList";
?>
    <div class="col-md-6">
      <h3> <?= $title ?> </h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Название</th>
            <th>Значение</th>
          </tr>
        </thead>
        <tbody>
          <?php
          self::_renderOutputItem(1, 'Плоттер', '{{' . $plotter . '}}');
          self::_renderOutputItem('{{index + 2}}', '{{item.title}}', '{{item.value}}', ['v-for="(item, index) in ' . $list . '"']);
          ?>
        </tbody>
      </table>
    </div>
  <?php
  }

  private static function _renderOutputItem($number, $title, $value, $attrs = [])
  {
  ?>
    <tr <?= join(' ', $attrs) ?>>
      <th scope="row"> <?= $number ?> </th>
      <td> <?= $title ?> </td>
      <td> <?= $value ?> </td>
    </tr>
<?php
  }
}
