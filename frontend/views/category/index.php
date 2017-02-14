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

    <!--Advertisement Banners-->
<!--    <div class="row mt30">-->
<!--        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/850x150.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/850x150.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--    </div>-->

    <!--#############################################################################################################-->

    <!--Basic List-->
    <?php echo $this->render('_basic', [
        'model' => $model,
        'basic_places' => $basic_places,
    ]); ?>

    <!--#############################################################################################################-->

    <!--Advertisement Banners-->
<!--    <div class="row mt30">-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
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

    <!--Advertisement Banners-->
<!--    <div class="row mt30">-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Advertise Here" alt="Ads">-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">-->
<!--            <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/165x165.png&text=Call +250788590179" alt="Ads">-->
<!--        </div>-->
<!--    </div>-->

    <!--#############################################################################################################-->


    <!--Free List-->
    <?php echo $this->render('_free', [
        'model' => $model,
        'free_places' => $free_places,
    ]); ?>

</div>

