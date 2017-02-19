<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' - ' . $model->name;
?>

<div class="container">

    <!--Premium List-->
    <?php echo $this->render('_premium', [
        'model' => $model,
        'premium_places' => $premium_places,
        'services' => $services,
        'a_places' => $a_places,
        'recent_added_places' => $recent_added_places,
        'get_most_viewed' => $get_most_viewed,
    ]); ?>

    <!--#############################################################################################################-->

    <!--Advertisement Banners 840x120-->
<!--    --><?php //if (!empty($ads['840x120'])) : ?>
<!--        <div class="row mt30">-->
<!--            --><?php //foreach ($ads['840x120'] as $ad) : ?>
<!---->
<!--<!--                -->--><?php ////if ($ad->image != '') : ?>
<!--                    --><?php //echo $ad->title ?>
<!--                    <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">-->
<!--                        <a href="--><?php //echo $ad->url ?><!--" target="_blank">-->
<!--                            <img class="img-responsive div"-->
<!--                                 src="--><?php //echo Yii::$app->params['ads_images'] . $ad->image ?><!--"-->
<!--                                 alt="--><?php //echo $ad->title ?><!--">-->
<!--                        </a>-->
<!--                    </div>-->
<!--<!--                -->--><?php ////endif; ?>
<!--            --><?php //endforeach; ?>
<!--        </div>-->
<!--    --><?php //endif; ?>


    <!--#############################################################################################################-->

    <!--Basic List-->
    <?php echo $this->render('_basic', [
        'model' => $model,
        'basic_places' => $basic_places,
    ]); ?>

    <!--#############################################################################################################-->

    <!--Advertisement Banners 250x250-->
<!--    <div class="row mt30">-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/250x250.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/250x250.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/250x250.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-3">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/250x250.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--    </div>-->

    <!--#############################################################################################################-->

    <!--Free List-->
    <?php echo $this->render('_articles', [
        'model' => $model,
        'articles' => $articles,
        'news' => $news,
    ]); ?>

    <!--#############################################################################################################-->

    <!--Advertisement Banners 180x150-->
<!--    <div class="row mt30">-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <a href="#" target="_blank"><img class="img-responsive div" style="margin: 0 auto;"-->
<!--                                             src="http://placehold.it/180x150.png&text=Advertise Here" alt="Ads"></a>-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/180x150.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/180x150.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/180x150.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/180x150.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive div" style="margin: 0 auto;"-->
<!--                 src="http://placehold.it/180x150.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--    </div>-->

    <!--#############################################################################################################-->


    <!--Free List-->
    <?php echo $this->render('_free', [
        'model' => $model,
        'free_places' => $free_places,
    ]); ?>

</div>

