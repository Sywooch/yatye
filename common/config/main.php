<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Africa/Kigali',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache', // in case I want to clear cache : ./yii cache/flush-all
        ],

        'session' => [
            'class' => 'yii\web\DbSession',
        ],

        'assetManager' => require(__DIR__ . '/asset-manager.php'),
    ],

    'modules' => require(__DIR__ . '/modules.php'),
];
