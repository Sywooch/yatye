<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/12/2016
 * Time: 22:34
 */

use yii\helpers\Url;

?>
    <div class="container">
        <div class="block background-white p30 row div">
            <div class="text-center" style="margin-top: -30px">
                <h1><?php echo Yii::t('app', 'Upcoming events') ?></h1>
            </div>
            <div class="cards-wrapper">
                <div class="row">
                    <div class="grid">
                        <?php if (!empty($up_coming_events)):
                            foreach ($up_coming_events as $event):?>

                                <div class="grid-item col-xs-12 col-sm-3">
                                    <div class="card" data-background-image="<?php echo ($event->banner != null) ? Yii::$app->params['event_images'] . $event->banner : Yii::$app->params['tmp'] . 'product-3.jpg' ?>">
                                        <div class="card-label">
                                            <?php
                                            $date = new DateTime();
                                            $match_date = new DateTime($event->start_at);
                                            $interval = $date->diff($match_date);

                                            if ($interval->days == 0): ?>
                                                <a href="<?php echo Url::to(['/upcoming-event/' . $event->slug]) ?>"><?php echo Yii::t('app', 'Today') ?></a>
                                            <?php else : ?>
                                                <a href="#"><?php echo date('D d M', strtotime($event->start_at)) ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-content">
                                            <h2 style="font-size: 18px;">
                                                <a href="<?php echo Url::to(['/upcoming-event/' . $event->slug]) ?>"><?php echo $event->name ?></a>
                                            </h2>
                                            <?php if ($event->address != null): ?>
                                                <div class="card-meta">
                                                    <i class="fa fa-map-o"></i> <?php echo $event->address ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="card-actions">
                                                <a href="<?php echo Url::to(['/upcoming-event/' . $event->slug]) ?>"
                                                   class="fa fa-eye"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $this->registerJs("
        $(function(){
            var m = new Masonry($('.grid').get()[0], {
                itemSelector: \".grid-item\"
            });
        });
    "); ?>