<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 11:45 AM
 */

return [
    'linkAssets' => true,
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
];