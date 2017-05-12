<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 4:10 PM
 */

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'place-details/<slug>' => 'place-details/slug',
        'premium-list/<slug>' => 'premium-list/slug/',
        'basic-list/<slug>' => 'basic-list/slug/',
        'category/<slug>' => 'category/slug',
        'free-list/<slug>' => 'list/slug/',
        'service/<slug>' => 'service/slug',

        'post-preview/<slug>' => 'post-preview/slug',
        'post-details/<slug>' => 'post-details/slug',
        'post-category/<slug>' => 'post-category/slug',
        'post-type/<slug>' => 'post-type/slug',

        'upcoming-event/<slug>' => 'upcoming-event/slug',
        'about-us/<slug>' => 'about-us/slug',

        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        '<action:(login|logout)>' => 'user/security/<action>',
        '<controller:\w+>/<id:\d+>/<slug:[A-Za-z0-9 -_.]+>' => '<controller>/view',

        'robots.txt' => 'site/robots',
        ['pattern' => 'sitemap', 'route' => 'site/sitemap', 'suffix' => '.xml'],
    ]

];