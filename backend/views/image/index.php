<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'alias',
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::img(Reasanik::$galleryPath . 'thumbs/' . $data->image_name,
                        [
                            'alt' => $data->name,
                        ]
                    );
                },
            ],
            // 'image_name',
            'description:ntext',
            // 'created_at',
            // 'updated_at',
            // 'meta_keys:ntext',
            // 'meta_desc:ntext',
            [
                'label' => 'Альбом',
                'value' => 'cat.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
