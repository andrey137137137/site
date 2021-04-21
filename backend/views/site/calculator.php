<?php

use backend\Reasanik;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?= Html::beginForm('', 'post', ['id' => 'calculator']) ?>

<h2>ВВОД</h2>

<?= Reasanik::beginFormGroup() ?>
<?php
Reasanik::renderInput('Курс', 'course');
Reasanik::renderInput('Плёнка', 'membrane');
Reasanik::renderInput('Монтажка', 'montaging');
Reasanik::renderInput('Процент', 'percent', 100);
Reasanik::renderInput('Ширина', 'width');
Reasanik::renderInput('Высота', 'height');
Reasanik::renderInput('Рез', 'slicing');
Reasanik::renderInput('Порезка', 'cutting');
Reasanik::renderInput('Печать', 'printing');
Reasanik::renderInput('Ламинация', 'lamination');
?>
<?= Reasanik::endFormGroup() ?>

<h2>ВЫВОД</h2>

<?= Reasanik::beginFormGroup() ?>
<?php
Reasanik::renderOutput();
Reasanik::renderOutput(true);
?>
<?= Reasanik::endFormGroup() ?>

<?= Html::endForm() ?>