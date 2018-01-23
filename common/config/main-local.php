<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            // 'dsn' => 'mysql:host=rsnik.mysql.tools;dbname=rsnik_db',
            // 'username' => 'rsnik_db',
            // 'password' => 'BHaMxSZd',
            'dsn' => 'mysql:host=localhost;dbname=rscom_db',
            'username' => 'rscom_db',
            'password' => 'YUZwVNNt',
            'charset' => 'utf8',
            'tablePrefix' => 'rs_gallery_'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
