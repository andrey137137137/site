<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/style.min.css',
  ];
  // public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
  public $js = [
    // ['js/lib/picturefill.js', 'position' => \yii\web\View::POS_HEAD, 'async' => true],
    // 'https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js',
    'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',
    'js/lib/jquery-3.2.0.min.js',
    'js/lib/jquery-migrate-3.0.0.min.js',
    'js/parallax.js',
    'js/lib/responsiveslides.js',
    'js/lib/sly.min.js',
    'js/fixBars.js',
    'js/carousel.js'
  ];
}
