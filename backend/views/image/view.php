<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Image */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить это изображение?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            // 'alias',
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::img(Reasanik::$galleryPath . 'images/' . $data->id . $data->ext,
                        [
                            'alt' => $data->title,
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
            [
                'label' => 'Альбом',
                'value' => $model->cat->title
            ],
            // [
            //     'label' => 'cat_id',
            //     'value' => $model->cat->title,
            // ],
        ],
    ]) ?>

</div>
