<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::$app->name;

?>
<div class="main">
    <div class="main-inner" style="padding: 1px">
        <div class="content">
            <div class="container">
                <div id="directory" class="block background-white p30 mt30 mb30 row div">
                    <div class="cards-wrapper ">
                        <div class="row grid">
                            <div class="col-xs-12 col-sm-4 item">
                                <div class="text-justify" style="height: 300px; margin: 0 0 10px;">
                                    <h1 style="font-size: 20px;"
                                        class="text-center"><?php echo Yii::t('app', 'Have you ever been to Rwanda?') ?></h1>

                                    <p class="text-center"><?php echo Yii::t('app', 'Want to visit and don\'t know where to start?') ?>
                                        <br> <?php echo Yii::t('app', 'Don\'t worry, we got your back.') ?></p>
                                    <p>Rwanda Guide is a new resource for visitors that are not familiar with Rwanda.
                                        It will help ease the stress of visiting a new country,
                                        and it will assist you in making use of your precious time here in our
                                        country. We hope you have a memorable time in our great country of Rwanda.</p>
                                    <p class="text-center" style="color: #000000;"><i><b>Enjoy the wonderful land of a
                                                thousand hills!</b></i></p>
                                </div>
                            </div>
                            <?php if (!empty($service_categories)):foreach ($service_categories as $category): ?>
                                <div class="col-xs-12 col-sm-4 item">
                                    <div class="card" data-background-image="<?php echo $category->getGalleries() ?>">
                                        <div class="card-content">
                                            <h2>
                                                <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"><?php echo $category->name ?></a>
                                            </h2>
                                            <div class="card-actions">
                                                <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"
                                                   class="fa fa-eye"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;endif; ?>
                        </div>
                    </div>
                </div>
            </div>


            <!--Advertisement Banners-->
            <!--            <div class="container">-->
            <!--                <div class="row" style="padding: 15px;">-->
            <!--                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">-->
            <!--                        <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/850x150.png&text=Advertise Here" alt="Ads">-->
            <!--                    </div>-->
            <!--                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">-->
            <!--                        <img class="img-responsive" style="margin: 0 auto;" src="http://placehold.it/850x150.png&text=Call +250788590179" alt="Ads">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--Up coming events-->

<!--            <div class="container">-->
<!--                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
<!--                    <!-- LightWidget WIDGET -->-->
<!--                    <script src="//lightwidget.com/widgets/lightwidget.js"></script>-->
<!--                    <iframe src="//lightwidget.com/widgets/6ed41707b813505fa22ced8199c71529.html" scrolling="no"-->
<!--                            allowtransparency="true" class="lightwidget-widget"-->
<!--                            style="width: 100%; border: 0; overflow: hidden;"></iframe>-->
<!--                </div>-->
<!--            </div>-->
            <?php $data = $this->context->accessData();
            $upcoming_events = $data['get_upcoming_events'];
            $count = count($upcoming_events);
            if (!empty($upcoming_events) && $count >= 4) :
                echo $this->render('_events', [
                    'up_coming_events' => $upcoming_events,
                ]);
            endif; ?>

        </div>
    </div>
</div>
<?php $this->registerJs("
        $(function(){
            var m = new Masonry($('.grid').get()[0], {
                itemSelector: \".item\"
            });
        });
    "); ?>
