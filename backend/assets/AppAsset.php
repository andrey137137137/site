<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/site.css',
  ];
  public $js = [
    // 'js/lib/jquery-3.2.0.min.js',
    // 'js/lib/jquery-migrate-3.0.0.min.js',
    'js/lib/jquery.ddslick.js',
    'js/script.js',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset'
  ];
}
