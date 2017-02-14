<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2015
 * Time: 19:52
 */
use kartik\widgets\Growl;

if (Yii::$app->session->getFlash("success")):
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Well done!',
        'icon' => 'glyphicon glyphicon-thumbs-up',
        'body' => Yii::$app->session->getFlash("success"),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
endif;

if (Yii::$app->session->getFlash("fail")):
    echo Growl::widget([
        'type' => Growl::TYPE_WARNING,
        'title' => 'Oops!',
        'icon' => 'glyphicon glyphicon-thumbs-down',
        'body' => Yii::$app->session->getFlash("fail"),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
endif;
?>