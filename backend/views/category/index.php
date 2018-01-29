<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Альбомы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'alias',
            // 'main_image_id',
            // 'mainImage.title',
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
            // 'mainImage.ext',
            'description:ntext',
            [   
                'label' => 'Родительский альбом',
                'value' => 'parent.title'
            ],
            'is_main',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
