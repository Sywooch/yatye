<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2015
 * Time: 19:52
 */
use kartik\growl\Growl;

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
    Yii::$app->getSession()->removeFlash('success');
endif;

if (Yii::$app->session->getFlash("fail")):
    echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => 'Error!',
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
    Yii::$app->getSession()->removeFlash('fail');
endif;

if (Yii::$app->session->getFlash("rwanda_guide_message")):
    echo Growl::widget([
        'type' => Growl::TYPE_GROWL,
        'title' => 'Happy Easter! ',
//        'icon' => Yii::$app->params['logo_256'],
        'body' => Yii::$app->session->getFlash("rwanda_guide_message"),
        'showSeparator' => true,
        'delay' => 9000,
//        'options'=>['style'=>['background-color'=>'#5d4942']],
        'progressBarOptions' => ['class' => 'progress-bar-warning'],
        'pluginOptions' => [
            'showProgressbar' => false,
            'icon_type' => 'image',
            'timer' => 5000,
//            'animate' => [
//                'enter' => 'animated fadeOutUp',
//                'exit' => 'animated fadeInDown',
//            ],
            'placement' => [
                'from' => 'bottom',
                'align' => 'center',
            ],
        ]
    ]);
    Yii::$app->getSession()->removeFlash('rwanda_guide_message');

endif;



echo Growl::widget([
    'type' => Growl::TYPE_GROWL,
    'title' => 'Ishyiga Live',
    'icon' => 'glyphicon glyphicon-info-sign',
    'body' => 'Search drug availability in Rwanda',
    'showSeparator' => true,
    'delay' => 1500,
    'linkUrl' => 'http://ishyiga.net/umuti/',
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ]
    ]
]);




//echo Growl::widget([
//    'type' => Growl::TYPE_GROWL,
//    'title' => '<div class="text-center">Kwibuka 23 : The 23rd commemoration of the Genocide against the Tutsi</div>',
//    'icon' => Yii::$app->params['kwibuka'],
//    'showSeparator' => true,
//    'delay' => 2000,
//    'linkUrl' => 'http://rwandaguide.info/post-details/kwibuka',
//    'pluginOptions' => [
//        'showProgressbar' => false,
//        'icon_type' => 'image',
//        'timer' => 10000,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'center',
//        ],
//    ]
//]);

//echo Growl::widget([
//    'type' => Growl::TYPE_GROWL,
//    'title' => '<div class="text-center" style="color: #FFFFFF; font-size: xx-large;">Eid Mubārak</div>',
////    'icon' => Yii::$app->params['kwibuka'],
////    'body' => '',
//    'showSeparator' => false,
//    'delay' => 5000,
//    'pluginOptions' => [
//        'showProgressbar' => false,
//        'icon_type' => 'image',
//        'timer' => 10000,
//        'placement' => [
//            'from' => 'bottom',
//            'align' => 'center',
//        ],
//    ]
//]);

//echo Growl::widget([
//    'type' => Growl::TYPE_GROWL,
//    'title' => '<div class="text-center" style="color: red; font-size: xx-large;">Merry Christmas!</div>',
//    'showSeparator' => false,
//    'delay' => 5000,
//    'pluginOptions' => [
//        'showProgressbar' => false,
//        'icon_type' => 'image',
//        'timer' => 10000,
//        'placement' => [
//            'from' => 'bottom',
//            'align' => 'center',
//        ],
//    ]
//]);

//echo Growl::widget([
//    'type' => Growl::TYPE_PASTEL,
////    'title' => '<div class="text-center" style="color: #c6af5c;">Happy New Year!</div>',
////    'icon' => Yii::$app->params['frontend'] . Yii::$app->params['images'] . 'Happy-New-Year-Gif-Image-for-Facebook.gif',
//    'icon' => Yii::$app->params['frontend'] . Yii::$app->params['images'] . 'Happy-New-Year-Gif-for-Facebook.gif',
//    'iconOptions'=>['style'=>'width:100%;'],
//    'options'=>['style'=>'width:61%;'],
//    'useAnimation' => true,
//    'showSeparator' => true,
//    'delay' => 2000,
//    'pluginOptions' => [
//        'showProgressbar' => false,
//        'icon_type' => 'image',
//        'timer' => 10000,
//        'placement' => [
//            'from' => 'top',
//            'align' => 'center',
//        ],
//    ]
//]);
?>