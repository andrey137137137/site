<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;

AppAsset::register($this);

$this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

  <div class="main-wrapper">

    <header id="main-header" class="main-header">
      <div class="container">
    
        <?php
          echo Html::beginTag('a', ['href' => '/', 'class' => 'logo']);
            echo Html::img('/img/logo.png',
                            [
                                'alt' => 'Reasanik',
                                // 'style' => 'width:15px;'
                            ]
                        );
          echo Html::endTag('a');
        ?>
    
        <nav>
          <div id="menu-check" class="menu-check"></div>
          <?php
            $menuItems = [
                ['label' => 'Главная', 'url' => ['site/index']],
                ['label' => 'Фото', 'url' => ['site/category']],
                ['label' => 'Контакты', 'url' => ['site/contact']],
            ];
      
            echo Menu::widget([
              'items' => $menuItems,
              'options' => ['id' => 'main-menu', 'class' => 'hor-menu main-menu'],
            ]);
          ?>
        </nav>

      </div>
    </header>

    <main>
      <div class="container">
        <?php
          echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'hor-menu breadcrumbs'],
           ]);
          echo Alert::widget();
          echo $content;
         ?>
      </div>
    </main>
  </div>

  <footer id="main-footer" class="main-footer">
    <div class="container">
      <?= Menu::widget([
        'items' => $menuItems,
        'options' => ['class' => 'hor-menu'],
      ]) ?>
    </div>
  </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
