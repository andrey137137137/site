<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

extract($params);
$image = $model->id . $model->mainImage->ext;

?>

<div class="category-form">

  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'parent_id')->dropDownList($parentsList) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_main')->checkbox(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php
        if ($model->isNewRecord)
        {
            // echo $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);
            echo $form->field($model, 'imageFiles[]')->widget(
                FileInput::classname(), 
                ['options' => ['multiple' => true, 'accept' => 'image/*'],]
            );
        }
    ?>

    <?= Html::dropDownList('', null, $dropDownList, [
        'id' => 'main_image_dropdownlist',
        'options' => $imagesList
    ]) ?>

    <?= $form->field($model, 'main_image_id')->dropDownList($dropDownList, [
        'id' => 'main_image_hidden_input'
        // 'options' => $imagesList
    ]) ?>

    <!-- ?= $form->field($model, 'main_image_id')->textInput(['id' => 'main_image_hidden_input', 'maxlength' => true]) ?> -->

    <?php if ( ! $model->isNewRecord && file_exists(Yii::getAlias('@gallery') . '/categories/' . $image)): ?>

      <div>
        <?= Html::img(Reasanik::$galleryPath . 'categories/' . $image, ['alt' => $model->title]) ?>
      </div>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
