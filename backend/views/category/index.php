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
            'name',
            'alias',
            // 'main_image_id',
            // 'mainImage.name',
            [   
                'label' => 'Родительский альбом',
                'value' => 'parent.name'
            ],
            [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function($data)
                {
                    return Html::img(
                        Reasanik::$galleryPath . 'categories/' . $data->mainImage->image_name,
                        ['alt' => $data->name]
                    );
                },
            ],
            // 'mainImage.image_name',
            'description:ntext',
            'is_main',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
