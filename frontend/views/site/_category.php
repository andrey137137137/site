<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

extract($params);

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if ( ! empty($images)): ?>

  <!-- <div> -->
  <!-- <div class="container"> -->

    <div class="wrap-frame main-slider">
      <div class="inside-left-top corner"></div>
      <div class="inside-right-top corner"></div>
      <div class="outside-left-top corner"></div>
      <div class="outside-right-top corner"></div>
      <div class="outside-left-bottom corner"></div>
      <div class="outside-right-bottom corner"></div>
      <div class="inside-left-bottom corner"></div>
      <div class="inside-right-bottom corner"></div>

      <div id="rs-slider" class="frame">

        <?php foreach ($images as $i => $image): ?>

          <div class="wrap-image" data-number="<?= $i ?>">
            <picture>
              <source srcset="examples/images/extralarge.jpg" media="(min-width: 1000px)">
              <source srcset="examples/images/art-large.jpg" media="(min-width: 800px)">
              <img srcset="<?= Reasanik::$galleryPath . 'images/' . $image->id . $image->ext ?>" alt="<?= $image->cat_id . ' : ' . $image->id . ' : ' . $image->title ?>">
            </picture>
            <?php
              // Html::img(Reasanik::$galleryPath . 'images/' . $image->id . $image->ext,
              //   [
              //       'alt' => $image->cat_id . ' : ' . $image->id . ' : ' . $image->title,
              //       // 'style' => 'width:15px;'
              //   ]
              // )
            ?>
          </div>

        <?php endforeach; ?>

      </div>
    </div>

    <div class="wrap-carousel">
      <div id="carousel" class="carousel">
        <ul class="simple-slider">

          <!-- Thumbnails -->
          <?php foreach ($images as $i => $image): ?>

            <li class="slide" data-number="<?= $i ?>">
              <div class="perforation">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>

              <article class="frame">
                <a class="wrap-image" href="#">
                  <?= Html::img(Reasanik::$galleryPath . 'thumbs/' . $image->id . $image->ext,
                            [
                                'alt' => $image->cat_id . ' : ' . $image->id . ' : ' . $image->title,
                                // 'style' => 'width:15px;'
                            ]
                        ) ?>
                </a>
              </article>

              <div class="perforation">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
              </div>
            </li> 

          <?php endforeach; ?>

        </ul>

        <div class="carousel-nav left">
          <div id="prev-page"></div>
          <div id="backward"></div>
        </div>

        <div class="carousel-nav right">
          <div id="forward"></div>
          <div id="next-page"></div>
        </div>

      </div>
    <!-- 
      <div class="nav flex-container">
        <div class="btn toStart">|&lt;</div>
        <div class="btn prev">&lt; prev</div>
        <div class="btn toCenter">center</div>
        <div class="btn next">next &gt;</div>
        <div class="btn toEnd">&gt;|</div>
      </div>
     -->
    </div>
  <!-- </div> -->

<?php endif; ?>

<?php foreach ($categories as $key => $category): ?>

  <article class="category">

    <div class="wrap-frame active">
    <!-- <div class="wrap-frame"> -->

      <div class="inside-left-top corner"></div>
      <div class="inside-right-top corner"></div>
      <div class="outside-left-top corner"></div>
      <div class="outside-right-top corner"></div>
      <div class="outside-left-bottom corner"></div>
      <div class="outside-right-bottom corner"></div>
      <div class="inside-left-bottom corner"></div>
      <div class="inside-right-bottom corner"></div>

      <?= Html::beginTag('a', ['href' => '/site/category?id=' . $category->id, 'class' => 'frame']) ?>
        <div class="wrap-image">
          <?= Html::img(Reasanik::$galleryPath . 'categories/' . $category->id . $category->mainImage->ext,
                      [
                          'alt' => $category->title,
                          // 'style' => 'width:15px;'
                      ]
                  ) ?>
        </div>
        <!-- <div class="foreground image-container">
          <image src="" alt="">
        </div> -->
      <?= Html::endTag('a') ?>

    </div>

    <h2 class="category_header"><?= Html::encode($category->title) ?></h2>
    <p class="category_desc"><?= Html::encode($category->description) ?></p>

  </article>

<?php endforeach; ?>
