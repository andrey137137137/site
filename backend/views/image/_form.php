<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Image */
/* @var $form yii\widgets\ActiveForm */

extract($params);
$imageName = $model->id . '_' . $model->image_name;
?>

<div class="image-form">

  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

  <?= $form->field($model, 'cat_id')->dropDownList($dropDownList) ?>

  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

  <?php
    // echo $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']);

    // $url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg';
    // $url1 = Yii::getAlias('@gallery') . '/images/' . $imageName;
    $url1 = Reasanik::$galleryPath . 'images/' . $imageName;

    echo $form->field($model, 'imageFile')->widget(
        FileInput::classname(),
        [
          'options' => ['accept' => 'image/*'],
          'pluginOptions' => [
            'initialPreview' => [$url1],
            'initialPreviewAsData' => true,
            // 'initialPreviewConfig' => [
            //     ['caption' => "Moon.jpg", 'size' => 930321, 'width' => "120px", 'key' => 1, 'showRemove' => false,],
            // ],
            // 'showRemove' => true,
            // 'overwriteInitial' => false,
            // 'maxFileSize' => 100,
            // 'initialCaption' => "The Moon and the Earth"
          ]
        ]
    );
  ?>

<!-- 
  <?php if ( ! $model->isNewRecord && file_exists(Yii::getAlias('@gallery') . '/images/' . $imageName)): ?>

    <div>
      <?= Html::img(Reasanik::$galleryPath . 'images/' . $imageName, ['alt' => $model->name,]); ?>
    </div>

  <?php endif; ?>
 -->

  <?= $form->field($model, 'meta_keys')->textarea(['rows' => 6]) ?>

  <?= $form->field($model, 'meta_desc')->textarea(['rows' => 6]) ?>

  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
