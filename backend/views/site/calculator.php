<?php

use backend\Reasanik;
use yii\helpers\Html;

/* @var $this yii\web\View */

?>

<?= Html::beginForm('', 'post', ['id' => 'calculator']) ?>

<h2>ВВОД</h2>

<?php
echo Reasanik::beginFormRow();

echo Reasanik::beginFormGroup();
Reasanik::renderInput('Курс', 's');
Reasanik::renderInput('Плёнка', 'p');
Reasanik::renderInput('Монтажка', 'm');
echo Reasanik::endFormGroup();

echo Reasanik::beginFormGroup();
Reasanik::renderInput('Порезка', 'pr');
Reasanik::renderInput('Печать', 'pt');
Reasanik::renderInput('Ламинация', 'lam');
echo Reasanik::endFormGroup();

echo Reasanik::beginFormGroup();
Reasanik::renderInput('Ширина', 'w');
Reasanik::renderInput('Высота', 'h');
Reasanik::renderInput('Рез', 'r');
echo Reasanik::endFormGroup();

echo Reasanik::beginFormGroup();
Reasanik::renderInput('Процент', 'percent', 100);
echo Reasanik::endFormGroup();

echo Reasanik::endFormRow();
?>

<h2>ВЫВОД</h2>

<?php
echo Reasanik::beginFormRow();
Reasanik::renderOutput();
Reasanik::renderOutput(true);
echo Reasanik::endFormRow();

echo Html::endForm();
