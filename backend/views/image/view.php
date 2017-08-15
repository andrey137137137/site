<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'alias',
            [
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::img(Reasanik::$galleryPath . 'images/' . $data->id . $data->ext,
                        [
                            'alt' => $data->title,
                            // 'style' => 'width:15px;'
                        ]
                    );
                },
            ],
            'ext',
            'description:ntext',
            'create_at',
            'update_at',
            'meta_keys:ntext',
            'meta_desc:ntext',
            'cat.title',
            // [
            //     'label' => 'cat_id',
            //     'value' => $model->cat->title,
            // ],
        ],
    ]) ?>

</div>
