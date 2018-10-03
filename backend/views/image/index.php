<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Изображения';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
	['class' => 'kartik\grid\SerialColumn'],
	'id',
	[
		'class' => 'kartik\grid\EditableColumn',
		'attribute' => 'name',
		// 'pageSummary' => 'Page Total',
		'vAlign'=>'middle',
		'headerOptions'=>['class'=>'kv-sticky-column'],
		'contentOptions'=>['class'=>'kv-sticky-column'],
		'editableOptions'=>['header'=>'Name', 'size'=>'md']
	],
	'alias',
	// [
	//     'label' => 'Изображение',
	//     'format' => 'raw',
	//     'value' => function($data)
	//     {
	//         return Html::img(Reasanik::$galleryPath . 'thumbs/' . $data->image_name, ['alt' => $data->name]);
	//     },
	// ],
	[
		'attribute' => 'image_name',
		'content' => function ($model, $key, $index, $widget) {
			$image = $model->image_name
				? Reasanik::$galleryPath
					. 'thumbs/thumb_' . $model->id . '_'
					. $model->image_name
				: '/img/empty.png';
			// return Html::decode("<div class='img-wrap><img class='img-wrap__img src='/img/{$image}' alt='{$model->name}'></div>");
			return Html::img(
				$image,
				['class' => 'img_wrap__img frame__img', 'alt' => $model->name]
			);
		}
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
	[
	    'class' => 'kartik\grid\ActionColumn',
	    'dropdown' => false,
	    'vAlign'=>'middle',
	    'urlCreator' => function($action, $model, $key, $index) {
	      return Url::to([$action,'id'=>$key]);
	    },
	    'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
	    'updateOptions' => [
	        // 'title'=>$updateMsg,
	        'title'=>'',
	        'label'=>"<div class=\"btn btn-info btn-xs admin\"><i class=\"fa fa-pencil\"></i> ".Yii::t('app', 'Edit data')."</div>",
	        'data-toggle'=>'tooltip'
	    ],
	    'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
	],
	['class' => 'kartik\grid\CheckboxColumn']
];

$this->registerJs(
	'$(document).ready(function(){
		$(\'#MyButton\').click(function(){

			ids = $(\'#image-pjax\').yiiGridView(\'getSelectedRows\');
			count = ids.length;

			if (count > 0 && confirm(\'Are you sure to delete \' + count + \' item(s)?\'))
			{
				$.post(
					"delete-multiple", 
					{pk: ids},
					function () {
						$.pjax.reload({container:\'#image-pjax\'});
					}
				);
			}

		});
	});',
	\yii\web\View::POS_READY
);

?>
<div class="image-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<!-- <p>
		<?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
	</p> -->
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		// 'columns' => [
		//     ['class' => 'yii\grid\SerialColumn'],

		//     // 'id',
		//     'name',
		//     'alias',
		//     [
		//         'label' => 'Изображение',
		//         'format' => 'raw',
		//         'value' => function($data)
		//         {
		//             return Html::img(Reasanik::$galleryPath . 'thumbs/' . $data->image_name,
		//                 [
		//                     'alt' => $data->name,
		//                 ]
		//             );
		//         },
		//     ],
		//     // 'image_name',
		//     'description:ntext',
		//     // 'created_at',
		//     // 'updated_at',
		//     // 'meta_keys:ntext',
		//     // 'meta_desc:ntext',
		//     [
		//         'label' => 'Альбом',
		//         'value' => 'cat.name'
		//     ],

		//     ['class' => 'yii\grid\ActionColumn'],
		// ],
		'columns' => $gridColumns,
		'containerOptions' => [
			'class' => 'image-pjax-container',
			'style'=>'overflow: auto'							// only set when $responsive = false
		],
		'options' => ['id' => 'image-pjax'],
		// 'beforeHeader'=>[
		//     [
		//         'columns'=>[
		//             ['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
		//             ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
		//             ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
		//         ],
		//         'options'=>['class'=>'skip-export'] // remove this row from export
		//     ]
		// ],
		'toolbar' =>  [
			['content'=>
				Html::a(
					'<i class="glyphicon glyphicon-plus"></i>',
					['create'],
					[
						'role' => 'modal-remote',
						'type' => 'button',
						'title' => Yii::t('kvgrid', 'Add Book'),
						'class' => 'btn btn-success'
					]
				) . ' '
					. Html::a(
						'<i class="glyphicon glyphicon-repeat"></i>',
						[''],
						[
							'data-pjax' => 0,
							'class' => 'btn btn-default',
							'title' => Yii::t('kvgrid', 'Reset Grid')
						]
					)
					. '<input type="button" class="btn btn-info" value="Multiple Delete" id="MyButton" >'
			],
			// '{export}',
			'{toggleData}'
		],
		'pjax' => true,
    'pjaxSettings'=>[
      'neverTimeout'=>true,
    ],
		'bordered' => true,
		'striped' => false,
		'condensed' => false,
		'responsive' => true,
		'hover' => true,
		'floatHeader' => true,
		'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
		// 'showPageSummary' => true,
		'panel' => [
			'type' => GridView::TYPE_PRIMARY
		],
	]); ?>
</div>
