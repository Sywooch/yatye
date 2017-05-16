<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\assets;

/**
 * Description of SuperlistAsset
 *
 * @author ntezi
 */
use yii\web\AssetBundle;
use yii\web\View;

class SuperlistAsset extends AssetBundle {

    public $sourcePath = '@common/assets/superlist';
    public $basePath = '@vendor';
    public $css = [

//        'css/superlist.css',
        'css/superlist.min.css',
        'libraries/owl.carousel/assets/owl.carousel.css',
        'libraries/colorbox/example1/colorbox.css',
        'libraries/bootstrap-select/bootstrap-select.min.css',
        'libraries/bootstrap-fileinput/fileinput.min.css',
        'libraries/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
        'js/map.js',
        'libraries/colorbox/jquery.colorbox-min.js',
        'libraries/bootstrap-select/bootstrap-select.min.js',
        'libraries/jquery-google-map/infobox.js',
        'libraries/jquery-google-map/jquery-google-map.min.js',
        'libraries/jquery-google-map/markerclusterer.min.js',
        'libraries/owl.carousel/owl.carousel.min.js',
        'libraries/bootstrap-fileinput/fileinput.min.js',
        'js/superlist.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}
