<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 4:13 PM
 */

return [
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
];