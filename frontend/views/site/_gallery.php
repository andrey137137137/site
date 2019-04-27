<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

extract($params);

$perforationList = '<ul class="carousel__perforation_list">';

for ($j = 0; $j < 8; $j++)
  $perforationList .= '<li class="carousel__perforation_item"></li>';

$perforationList .= '</ul>';

$carSlideClass = 'carousel__slide';

function frameCorners($tag = 'div')
{
  $cornerClasses = [
    'frame_wrap__corner--inside_left_top',
    'frame_wrap__corner--inside_right_top',
    'frame_wrap__corner--outside_left_top',
    'frame_wrap__corner--outside_right_top',
    'frame_wrap__corner--outside_left_bottom',
    'frame_wrap__corner--outside_right_bottom',
    'frame_wrap__corner--inside_left_bottom',
    'frame_wrap__corner--inside_right_bottom'
  ];

  foreach ($cornerClasses as $i => $value)
  {
    echo '<' . $tag . ' class="frame_wrap__corner ' . $value . '"></' . $tag . '>';
  }
}

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if ( ! empty($images)): ?>

    <!-- <div> -->
    <!-- <div class="container"> -->

    <div id="mainSlider" class="frame_wrap main-slider">
        <?php frameCorners() ?>

        <div id="rs-slider" class="frame frame_wrap__frame">

            <?php foreach ($images as $i => $image)
            {
              
              // $tempImageName = $image->id . $image->ext;

            ?>

            <div class="img_wrap frame__img_wrap" data-number="<?= $i ?>">
                <!-- <picture class="frame__img_wrape" data-number="<?= $i ?>" style="display: block;"> <source srcset="<?= Reasanik::$galleryPath ?>extralarge/<?= $image->image_name ?>" media="(min-width: 1048px)"> <source srcset="<?= Reasanik::$galleryPath ?>large/<?= $image->image_name ?>" media="(min-width: 768px)"> <source srcset="<?= Reasanik::$galleryPath ?>medium/<?= $image->image_name ?>" media="(min-width: 500px)"> <img srcset="<?= Reasanik::$galleryPath ?>small/<?= $image->image_name ?>" alt="<?= $image->cat_id . ' : ' . $image->id . ' : ' . $image->name ?>"> </picture> -->
                <?= Html::img(
                  Reasanik::$galleryPath . 'images/'
                    . $image->id . '_' . $image->image_name,
                  ['class' => 'img_wrap__img frame__img', 'alt' => $image->name]
                ) ?>
            </div>

            <?php } ?>

        </div>
        <a id="rs-slider-prev" class="rslides_nav rslides1_nav prev" href="#"></a>
        <a id="rs-slider-next" class="rslides_nav rslides1_nav next" href="#"></a>
    </div>

      <!-- <ul class="simple-slider"></ul>
      <div class="carousel-nav left">
          <div id="prev-page"></div>
          <div id="backward"></div>
      </div>
      <div class="carousel-nav right">
          <div id="forward"></div>
          <div id="next-page"></div>
      </div> -->

    <!-- <div class="nav flex-container"> <div class="btn toStart">|&lt;</div> <div class="btn prev">&lt; prev</div> <div class="btn toCenter">center</div> <div class="btn next">next &gt;</div> <div class="btn toEnd">&gt;|</div> </div> -->

    <div class="wrap-carousel">
        <div id="carousel" class="carousel">

              <?php foreach ($images as $i => $image)
              {

                switch ($i)
                {
                  case 0:
                    $carSlideModif = 'first';
                    break;
                  case count($images) - 1:
                    $carSlideModif = 'last';
                    break;
                  default:
                    $carSlideModif = false;

                }

                $carSlideClasses = $carSlideClass;

                if ($carSlideModif)
                {
                  $carSlideClasses .= ' ' . $carSlideClass . '--' . $carSlideModif;
                }

                // $tempImageName = $image->id . $image->ext;

                ?>

                <div class="<?= $carSlideClasses ?>" data-number="<?= $i ?>">
                    <?= $perforationList ?>

                    <article class="frame carousel__frame">
                        <a class="frame__img_wrap" href="#" data-number="<?= $i ?>">
                            <!-- <picture class="wrap-image" data-number="<?= $i ?>" style="display: block;"> <source srcset="<?= Reasanik::$galleryPath ?>extralarge/<?= $image->image_name ?>" media="(min-width: 1048px)"> <source srcset="<?= Reasanik::$galleryPath ?>large/<?= $image->image_name ?>" media="(min-width: 768px)"> <source srcset="<?= Reasanik::$galleryPath ?>medium/<?= $image->image_name ?>" media="(min-width: 500px)"> <img srcset="<?= Reasanik::$galleryPath ?>small/<?= $image->image_name ?>" alt="<?= $image->cat_id . ' : ' . $image->id . ' : ' . $image->name ?>"> </picture> -->
                            <?= Html::img(
                        Reasanik::$galleryPath . 'thumbs/thumb_'
                          . $image->id . '_' . $image->image_name,
                        ['class' => 'frame__img', 'alt' => $image->name]
                      ) ?>
                        </a>
                    </article>

                    <?= $perforationList ?>
                </div>

              <?php }?>

        </div>
    </div>
    <!-- </div> -->

<?php endif; ?>

<?php foreach ($categories as $key => $category): ?>

<article class="category">

    <!-- <ul class="wrap-frame active"> -->
    <ul class="frame_wrap">

        <?php frameCorners('li') ?>

        <?= Html::beginTag('a', ['href' => '/site/category?id=' . $category->id, 'class' => 'frame frame_wrap__frame']) ?>
        <li class="frame__img_wrap">
            <?= Html::img(
            Reasanik::$galleryPath . 'categories/category_'
              . $category->id . '_' . $category->image_name,
            ['class' => 'frame__img', 'alt' => $category->name]
          ) ?>
        </li>
        <!-- <li class="foreground image-container"> <image src="" alt=""> </li> -->
        <?= Html::endTag('a') ?>

    </ul>

    <h2 class="category_header"><?= Html::encode($category->name) ?></h2>
    <p class="category_desc"><?= Html::encode($category->description) ?></p>

</article>

<?php endforeach; ?>