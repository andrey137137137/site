<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Image */
/* @var $form ActiveForm */
?>
<?= Html::beginForm('', 'post'); ?>

<div class="form-group">
    <?= Html::label('Название поля', 'FIELD-ID', ['class' => 'control-label']) ?>
    <?= Html::dropDownList('FIELD-ID', '', ['0' => 'нет', '1' => 'да'], ['class' => 'form-control',]); ?>
    <div class="hint-block">Выберите значение</div>
</div>

<div class="form-group">
    <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
</div>

<?php Html::endForm(); ?>