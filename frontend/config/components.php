<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 4:12 PM
 */

return [
    'request' => [
        'csrfParam' => '_csrf-frontend',
        'class' => 'common\components\Request',
        'web'=> '/frontend/web'
    ],
    'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
        'identityCookie' => [
            'name' => '_frontendIdentity',
            'path' => '/',
            'httpOnly' => true,
        ],
    ],
    'session' => [
        // this is the name of the session cookie used for login on the frontend
//            'name' => 'advanced-frontend',
        'name' => 'FRONTENDSESSID',
        'cookieParams' => [
            'httpOnly' => true,
            'path' => '/',
        ],
    ],

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

    'authClientCollection' => [
        'class' => yii\authclient\Collection::className(),
        'clients' => [
            'facebook' => [
                'class' => 'dektrium\user\clients\Facebook',
                'clientId' => '1569960559930538',
                'clientSecret' => '3a6c07c79078a76b5171499dd0ccaeb6',
            ],
            'twitter' => [
                'class' => 'dektrium\user\clients\Twitter',
                'consumerKey' => '4lTUDhdMMtSWoP6QYr7w84619',
                'consumerSecret' => 'dMH3nq1QyM0cdT97d2t3L9oExQel2VqN30uCsZMRaCO3gSHwDW',
            ],
            'google' => [
                'class' => 'dektrium\user\clients\Google',
                'clientId' => '115206972773-vm0rgm75o2ibu2ecl12g4lka6jh4m99q.apps.googleusercontent.com',
                'clientSecret' => 'GOfNXVyRmF2_JIJmM4k1UMO_',
            ],
            'linkedin' => [
                'class' => 'yii\authclient\clients\LinkedIn',
                'clientId' => 'your client id',
                'clientSecret' => 'your client secret',
            ],
        ],
    ],

    'view' => [
        'theme' => [
            'pathMap' => [
                '@dektrium/user/views' => '@frontend/views/user',
            ],
        ],
    ],

    'urlManager' => require(__DIR__ . '/routes.php'),

];