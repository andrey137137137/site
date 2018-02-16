<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Image */
/* @var $form yii\widgets\ActiveForm */

extract($params);
$image = $model->id . $model->ext;

?>

<div class="image-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'cat_id')->dropDownList($dropDownList) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
        // echo $form->field($model, 'image')->fileInput(['accept' => 'image/*']);
        echo $form->field($model, 'image')->widget(
            FileInput::classname(), 
            ['options' => ['accept' => 'image/*'],]
        );
    ?>

    <?php if ( ! $model->isNewRecord && file_exists(Yii::getAlias('@gallery') . '/images/' . $image)): ?>

        <div>
            <?= Html::img(Reasanik::$galleryPath . 'images/' . $image,
                [
                    'alt' => $model->title,
                ]
            ); ?>
        </div>

    <?php endif; ?>

    <?= $form->field($model, 'meta_keys')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
