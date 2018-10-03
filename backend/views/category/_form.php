<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */

extract($params);
// $imageName = $model->id . $model->mainImage->image_name;
$imageName = 'category_' . $model->id . '_' . $model->image_name;

?>

<div class="category-form">

  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

  <?= $form->field($model, 'parent_id')->dropDownList($parentsList) ?>

  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'is_main')->checkbox(['maxlength' => true]) ?>

  <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

  <?php if ($model->isNewRecord) {
    // echo $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);
    echo $form->field($model, 'imageFiles[]')->widget(
      FileInput::classname(), 
      [
        'options' => ['multiple' => true, 'accept' => 'image/*'],
        'pluginOptions' => [
          'showRemove' => true
        ]
      ]
    );
  } ?>

  <?= Html::dropDownList('', null, $dropDownList, [
    'id' => 'main_image_dropdownlist',
    'options' => $imagesList
  ]) ?>

  <!-- ?= $form->field($model, 'main_image_id')->dropDownList($dropDownList, [
    'id' => 'main_image_hidden_input'
    // 'options' => $imagesList
  ]) ?> -->

  <?= $form->field($model, 'main_image_id')->hiddenInput(['id' => 'main_image_hidden_input', 'maxlength' => true]) ?>

  <?php if (!$model->isNewRecord && file_exists(Yii::getAlias('@gallery') . '/categories/' . $imageName)): ?>

    <div>
    <?= Html::img(Reasanik::$galleryPath . 'categories/' . $imageName, ['alt' => $model->name]) ?>
    </div>

  <?php endif; ?>

  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
