<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/02/2016
 * Time: 13:07
 */

namespace backend\assets;

use yii\web\AssetBundle;

class RwandaguideAsset extends AssetBundle{

    public $sourcePath = '@app/../dist/rwandaguide';
    public $basePath = '@vendor';
    public $css = [
//        'css/rwandaguide.css',
        'css/rwandaguide.min.css',
        'css/bootstrap-tour.min.css',
    ];
    public $js = [
        'js/rwandaguide.js',
        'js/jquery.duplicate.min.js',
        'js/bootstrap-tour.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}