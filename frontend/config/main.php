<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'Rwanda Guide',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',

            'controllerMap' => [
                'security' => 'frontend\controllers\user\SecurityController',
                'registration' => 'frontend\controllers\user\RegistrationController',
                'recovery' => 'frontend\controllers\user\RecoveryController',
            ],
        ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the Disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],

            // the global settings for the Facebook plugins widget
            'facebook' => [
                'appId' => '1569960559930538',
                'secret' => '3a6c07c79078a76b5171499dd0ccaeb6',
            ],

            // the global settings for the Google+ Plugins widget
            'google' => [
                'clientId' => '115206972773-vm0rgm75o2ibu2ecl12g4lka6jh4m99q.apps.googleusercontent.com',
                'pageId' => '110093583439725047827',
                'profileId' => '110341479395654851118',
            ],

            // the global settings for the Google Analytics plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the Twitter plugin widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],

            // the global settings for the GitHub plugin widget
            'github' => [
                'settings' => ['user' => 'GITHUB_USER', 'repo' => 'GITHUB_REPO']
            ],
        ],
    ],
    'components' => [
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'place-details/<slug>' => 'place-details/slug',
                'category/<slug>' => 'category/slug',
                'premium-list/<slug>' => 'premium-list/slug/',
                'basic-list/<slug>' => 'basic-list/slug/',
                'free-list/<slug>' => 'list/slug/',
                'robots.txt'=>'site/robots',
                'service/<slug>' => 'service/slug',
                'post-details/<slug>' => 'post-details/slug',
                'post-category/<slug>' => 'post-category/slug',
                'articles/<slug>' => 'post-category/slug',
                'news/<slug>' => 'post-category/slug',
                'post-type/<slug>' => 'post-type/slug',
                'blog/<slug>' => 'blog/slug',
                'location/<slug>' => 'location/slug',
                'upcoming-event/<slug>' => 'upcoming-event/slug',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<action:(login|logout)>' => 'user/security/<action>',
                '<controller:\w+>/<id:\d+>/<slug:[A-Za-z0-9 -_.]+>' => '<controller>/view',
                ['pattern' => 'sitemap', 'route' => 'site/sitemap', 'suffix' => '.xml'],
            ]
        ]
    ],
    'params' => $params,
];
