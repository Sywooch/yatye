<?php
//return [
//    'components' => [
//        'db' => [
//            'class' => 'yii\db\Connection',
//            'dsn' => 'mysql:host=localhost;dbname=rguide01_db_005;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
//            'username' => 'root',
//            'password' => 'root',
//            'charset' => 'utf8',
//        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'rwandaguide2015@gmail.com',
//                'password' => 'rg02052015',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
//        ],
//        'BaseController' => [
//            'class' => 'common\components\BaseController'
//        ],
//    ],
//];

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=rguide01_db_008;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'enableSchemaCache' => true,

            // Duration of schema cache.
            'schemaCacheDuration' => 3600,

            // Name of the cache component used to store schema information
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'htmlLayout' => 'layouts/html',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.gmail.com',
//                'username' => 'rwandaguide2015@gmail.com',
//                'password' => 'rg02052015',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
        ],
        'BaseController' => [
            'class' => 'common\components\BaseController'
        ],
    ],
];
