<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;

// $parallax = [1, 1, 1, 1, 1, 0.6, 0.15, 0.1];

AppAsset::register($this);

$this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <!-- <script>
    // Picture element HTML5 shiv
    document.createElement( "picture" );
  </script> -->
  <!-- <script src="picturefill.js" async></script> -->
  <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

  <div class="parallax" id="parallax">
    <?php
    // foreach ($parallax as $i => $value) {
    //   $number = ++$i;
    //   echo Html::beginTag('div', [
    //     'class' => 'parallax-layer', 
    //     'data-depth' => $value
    //   ]);
    //     echo Html::img("/img/parallax/layer_${number}.png",
    //       [
    //         'class' => 'parallax-img',
    //         'alt' => 'Reasanik'
    //       ]
    //     );
    //   echo Html::endTag('div');
    // }
    ?>
  </div>

  <div class="main_wrapper">

    <header id="main-header" class="header">
      <div class="container">

        <?php
          echo Html::beginTag('a', ['href' => '/', 'class' => 'img_wrap logo']);
            echo Html::img('/img/logo.png',
                            [
                              'class' => 'img',
                                'alt' => 'Reasanik',
                                // 'style' => 'width:15px;'
                            ]
                        );
          echo Html::endTag('a');
        ?>

        <nav class="nav">
          <div id="menu-check" class="menu_checker"></div>
          <?php
            $menuItems = [
                ['class' => 'menu-link', 'label' => 'Главная', 'url' => ['site/index']],
                ['class' => 'menu-link', 'label' => 'Фото', 'url' => ['site/category']],
                ['class' => 'menu-link', 'label' => 'Контакты', 'url' => ['site/contact']],
            ];

            echo Menu::widget([
              'items' => $menuItems,
              'options' => ['id' => 'main-menu', 'class' => 'menu main_menu header-main_menu'],
            ]);
          ?>
        </nav>

      </div>
    </header>

    <main class="main">
      <div class="container main-container">
        <?php
          echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'menu breadcrumbs'],
           ]);
          echo Alert::widget();
          echo $content;
         ?>
      </div>
    </main>
  </div>

  <footer id="main-footer" class="footer">
    <div class="container footer-container">
      <?= Menu::widget([
        'items' => $menuItems,
        'options' => ['class' => 'menu footer-main_menu'],
      ]) ?>
    </div>
  </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
