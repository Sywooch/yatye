<?php

/* @var $this yii\web\View */
$this->title = Yii::$app->name;

?>
<div class="main">
    <div class="main-inner" style="padding: 1px">
        <div class="content">
            <!--Home -->
            <?php echo $this->render('_home', [
                'service_categories' => $service_categories,
            ]); ?>

            <!--Advertisement Banners-->
            <?php $ads = $this->context->getAds();
            if (!empty($ads)) : echo $this->render('_ads', [
                'ads' => $ads,
            ]); endif; ?>

            <!--Up coming events-->
            <?php $upcoming_events = $this->context->getUpcomingEvents();
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
