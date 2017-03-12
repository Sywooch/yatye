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

        'assetManager' => [
            'appendTimestamp' => true,
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        'jquery.min.js',
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
    ],

    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'mailer' => [
                'sender' => ['rwandaguide@rwandaguide.info' => 'Rwanda Guide'],
                'welcomeSubject' => 'Welcome to Rwanda Guide',
                'confirmationSubject' => 'Rwanda Guide Account Confirmation',
                'reconfirmationSubject' => 'Rwanda Guide Email Change Confirmation',
                'recoverySubject' => 'Rwanda Guide Password Recovery',
            ],
            'admins' => ['Marius'],
            'enableUnconfirmedLogin' => false,
            'enableGeneratingPassword' => true,
            'enableConfirmation' => true,
            'enablePasswordRecovery' => true,
            'modelMap' => [
                'User' => 'common\models\User',
                'LoginForm' => 'common\models\LoginForm',
                'RecoveryForm' => 'common\models\RecoveryForm',
            ],
        ],

        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
        ],

        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],

    ],
];
