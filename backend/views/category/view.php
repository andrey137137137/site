<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот альбом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent.title',
            // 'main_image_id',
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::img(Reasanik::$galleryPath . 'categories/' . $data->id . $data->mainImage->ext,
                        [
                            'alt' => $data->title,
                        ]
                    );
                },
            ],
            'mainImage.ext',
            'title',
            'alias',
            'description:ntext',
            'is_main'
        ],
    ]) ?>

</div>
