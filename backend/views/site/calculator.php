<?php

use backend\Reasanik;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?= Html::beginForm('', 'post', ['id' => 'calculator']) ?>

<h2>ВВОД</h2>

<?= Reasanik::beginFormGroup() ?>
<?php
Reasanik::renderInput('Курс', 's');
Reasanik::renderInput('Плёнка', 'p');
Reasanik::renderInput('Монтажка', 'm');

Reasanik::renderInput('Ширина', 'w');
Reasanik::renderInput('Высота', 'h');
Reasanik::renderInput('Рез', 'r');

Reasanik::renderInput('Порезка', 'pr');
Reasanik::renderInput('Печать', 'pt');
Reasanik::renderInput('Ламинация', 'lam');

Reasanik::renderInput('Процент', 'percent', 100);
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