<?php
$params = array_merge(
  require(__DIR__ . '/../../common/config/params.php'),
  require(__DIR__ . '/../../common/config/params-local.php'),
  require(__DIR__ . '/params.php'),
  require(__DIR__ . '/params-local.php')
);

return [
  'id' => 'app-backend',
  'basePath' => dirname(__DIR__),
  'homeUrl' => '/admin',
  'defaultRoute' => 'site/index',
  'controllerNamespace' => 'backend\controllers',
  // 'bootstrap' => ['log'],
  'modules' => [
    'gridview' =>  [
      'class' => '\kartik\grid\Module'
    ]
  ],
  'components' => [
    'request' => [
      'csrfParam' => '_csrf-backend',
      'baseUrl' => '/admin',
    ],
    'user' => [
      'identityClass' => 'backend\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the backend
      'name' => 'advanced-backend',
    ],
    // 'assetManager' => [
    //   'bundles' => [
    //     'yii\bootstrap\BootstrapAsset' => [
    //       'css' => []
    //     ],
    //     'yii\bootstrap\BootstrapPluginAsset' => [
    //       'js' => []
    //     ],
    //   ],
    // ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],

    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
        'calculator' => 'site/calculator',
        // '/' => 'site/index',
      ],
    ],

  ],
  'params' => $params,
];
