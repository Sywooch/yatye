<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/09/2016
 * Time: 12:33
 */

return [

    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/place',
        ],
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => 'v1/user',
            'extraPatterns' => [
                'POST login' => 'login',
            ],
        ],

        ['pattern' => '/', 'route' => 'site/index'],
        ['pattern' => 'v1//', 'route' => 'site/index'],
    ],
];
