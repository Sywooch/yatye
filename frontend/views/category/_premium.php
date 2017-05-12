<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:17
 */
/* @var $premium_place backend\models\place\Place */

use yii\helpers\Html;
?>
<?php if (!empty($premium_places)): ?>
<div class="block background-white mt30 mb50 row p30 div">
    <div class="col-md-7 col-lg-7">
        <div class="hero-slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $active = ' active';
                    foreach ($premium_places as $premium_place): ?>
                        <div class="item<?php echo $active; ?>">
                            <div class="item-bg" style="background-image: url(<?php echo $premium_place->getLogo() ?>)"></div>
                            <img style="width: 640px; height: 370px;" src="<?php echo $premium_place->getPhoto() ?>"
                                 alt="<?php echo $premium_place->name; ?>">
                            <div class="carousel-caption">
                                <div class="hero-slider-content">
                                    <h1><?php echo $premium_place->name; ?></h1>
                                    <div class="hero-slider-rating">
                                        <?php echo $premium_place->getRatingStars() ?>
                                    </div>
                                </div>

                                <div class="hero-slider-actions">
                                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']),
                                        $premium_place->getPlaceUrl(),
                                        ['target' => '_blank']) ?>
                                </div>
                            </div>
                        </div>
                        <?php $active = null; endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="prev">
                    <i class="fa fa-long-arrow-left"></i>
                </a>

                <a class="right carousel-control" href="#carousel-example-generic" role="button"
                   data-slide="next">
                    <i class="fa fa-long-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!--Right Side-->
    <div class="col-sm-5 col-lg-5">
        <?php echo $this->render('_right_side', [
            'model' => $model,
            'premium_places' => $premium_places,
            'services' => $services,
            'recent_added_places' => $recent_added_places,
            'get_most_viewed' => $get_most_viewed,
        ]); ?>
    </div>
</div>
<?php endif; ?>