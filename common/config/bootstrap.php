<?php

// require_once 'Reasanik.php';

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
// Yii::setAlias('@gallery', dirname(dirname(__DIR__)) . '/frontend/web/img/gallery');
Yii::setAlias('@gallery', dirname(dirname(__DIR__)) . '/frontend/web' . \Reasanik::$galleryPath);
// Yii::$classMap['yii\helpers\Inflector'] = '@common/ext/Inflector.php';