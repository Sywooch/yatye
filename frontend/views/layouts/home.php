<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      itemscope itemtype="http://schema.org/Website">
<head>
    <!--Recommended Meta Tags-->
    <?php echo $this->render('@app/views/layouts/meta-tags/_recommended_meta_tags') ?>

    <!--Search Engine Optimization Meta Tags-->
    <?php echo $this->render('@app/views/layouts/meta-tags/_seo_meta_tags') ?>

    <!-- Schema.org markup for Google+ -->
    <?php echo $this->render('@app/views/layouts/meta-tags/_google_meta_tags') ?>

    <!-- Twitter Card data -->
    <?php echo $this->render('@app/views/layouts/meta-tags/_twitter_meta_tags') ?>

    <!-- Open Graph data -->
    <?php echo $this->render('@app/views/layouts/meta-tags/_open_graph_data_meta_tags') ?>

    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

    <!--pre-load-->
    <?php $this->registerCss(".pre-load{display: none;} ") ?>

    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->params['icon_96']; ?>"/>
    <link rel="alternate" href="http://rwandaguide.info/" hreflang="x-default"/>
    <link rel="publisher" href="https://plus.google.com/u/0/110341479395654851118">

    <?php echo $this->render('@app/views/layouts/scripts/_facebook') ?>
    <?php echo $this->render('@app/views/layouts/scripts/_google') ?>

</head>
<body>

<?php $this->beginBody() ?>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=1569960559930538";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="page-wrapper">
    <header class="header">
        <div class="header-wrapper">
            <div class="container">
                <div class="header-inner">
                    <div class="header-logo">
                        <?php echo $this->render('@app/views/layouts/header/_header_logo') ?>
                    </div>
                    <div class="header-content">
                        <div class="header-top">
                            <?php echo $this->render('@app/views/layouts/header/_header_top') ?>
                        </div>
                        <div class="header-bottom">
                            <div class="header-action">
                                <?php echo $this->render('@app/views/layouts/header/_header_filter') ?>
                            </div>
                            <?php //echo $this->render('@app/views/layouts/header/_header_bottom') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php echo $this->render('@app/views/layouts/_messages') ?>
    <?= $content ?>
    <?php echo $this->render('@app/views/layouts/_footer') ?>
</div>
<?php echo $this->render('@app/views/layouts/scripts/_twitter') ?>
<?php echo $this->render('@app/views/layouts/scripts/_other_scripts') ?>
<?php $this->endBody() ?>

<script>
    // Instance the tour
    var tour = new Tour({
        steps: [
            {
                element: "#filter",
                title: "Filter",
                content: "When clicking on this button you go directly to the filter page. " +
                "You may get the filtered list based on your choices",
                placement: "left",
            },
            {
                element: "#directory",
                title: "Directory",
                content: "Start browsing our directory by clicking each category.",
                placement: "top",
            },
            {
                element: "#events",
                title: "Upcoming events",
                content: "Check out upcoming events",
                placement: "top",
            }
        ]});

    // Initialize the tour
    tour.init();

    // Start the tour
    tour.start();
//    tour.restart();

</script>

</body>
</html>
<?php $this->endPage() ?>
