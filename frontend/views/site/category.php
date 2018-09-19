<?php

/* @var $this yii\web\View */

$category = $params['category'];
$parents = $params['parents'];
unset($params['parents']);

$this->title = 'Фото';
$this->params['breadcrumbs'][] = $category ? ['label' => $this->title, 'url' => '/site/category'] : $this->title;

for ($i = count($parents) - 1; $i >= 0; $i--)
{
  $this->params['breadcrumbs'][] = ['label' => $parents[$i]['name'], 'url' => ['/site/category', 'id' => $parents[$i]['id']]];
}

if ($category)
{
  $this->title = $category->name;
  $this->params['breadcrumbs'][] = $this->title;
}

echo $this->render('_gallery', compact('params'));