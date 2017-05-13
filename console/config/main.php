<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacConsoleModule',
        'backup' => [
            'class' => 'console\modules\backup\Module',
            'backup' => [
                'db' => [
                    'enable' => true,
                    'data' => [ //TODO List of database which need to be backed up
                        'db',
                    ],
                ],
                'folder' => [
                    'enable' => false,
                    'data' => [ //TODO List of directories which need to be backed up
                        '@backend/web/uploads',
                    ],
                ],
            ],
            'transport' => [
                'mail' => [
                    'class' => '\console\modules\backup\transports\Mail',
                    'enable' => true, //TODO default true
                    'fromEmail' => 'support@gmail.com',
                    'toEmail' => 'rwandaguide.info@gmail.com',
                ],
                'ftp' => [
                    'class' => '\console\modules\backup\transports\Ftp',
                    'enable' => false, //TODO default false
                    'host' => 'ftp.example.com',
                    'user' => 'login',
                    'pass' => 'password',
                    'dir' => '/home/example/public_html/backup',
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'backup' => [
            'class' => 'console\controllers\BackupController',
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
            //'enableAutoLogin' => true,
        ],
        'session' => [ // for use session in console application
            'class' => 'yii\web\Session'
        ],
    ],
    'params' => $params,
];
