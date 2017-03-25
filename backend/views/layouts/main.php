<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->params['favicon']; ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$_header = '';
$_sidebar_admin = '';
if (!Yii::$app->user->isGuest):
    $_header = $this->render('_header');
    $_sidebar_admin = $this->render('_sidebar_admin');
endif;
?>

<div class="page-wrapper">
    <?php echo $this->render('@app/views/layouts/_messages') ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <?= $this->render('_header'); ?>
        <div class="main">
            <div class="outer-admin">
                <div class="wrapper-admin">
                    <?= $this->render('_sidebar_admin') ?>
                    <div class="content-admin">
                        <div class="content-admin-wrapper">
                            <div class="content-admin-main">
                                <div class="content-admin-main-inner">
                                    <div class="container-fluid">
                                        <?= $content ?>
                                    </div>
                                </div>
                            </div>

                            <div class="content-admin-footer">
                                <div class="container-fluid">
                                    <div class="content-admin-footer-inner">
                                        &copy; <?= Yii::$app->name . ' ' . date('Y') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <a href="<?php echo Yii::$app->request->baseUrl; ?>/">
                        <img style="width: 240px; margin-left: 15%; margin-top: 30px;"
                             src="<?= Yii::$app->params['logo_512'] ?>" alt="<?= Yii::$app->name ?>">
                    </a>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="main-inner">
                <div class="container">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4 div p30">
                                <div class="page-title text-center">
                                    <h4><?php echo Yii::$app->name; ?></h4>
                                </div>
                                <?= $content ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKwKajb1ecp_R0VUE4dTF1ch9G6drihXg"></script>-->
<script
    src="http://maps.googleapis.com/maps/api/js?libraries=weather,geometry,visualization,places,drawing&amp;sensor=false"
    type="text/javascript"></script>

<?php $this->registerJs("

//    $('a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
//        mapa();
//    });
//
    $('a[data-toggle=\"collapse\"]').on('shown.bs.collapse', function(e) {
        mapa();
    });

    ") ?>
<?php
$this->registerJs("

$(function(){
    $(document).on('click','.fc-day',function(){
        var date = $(this).attr('data-date');

        $.get('index.php?r=event/create',{'date':date},function(data){
            $('#modal').modal('show')
                .find('#modalContent')
                .html(data);
        });
    });

    // get the click of the create button
    $('#modalButton').click(function (){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
});

")
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
