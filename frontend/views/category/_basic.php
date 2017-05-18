<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:05
 */
/* @var $basic_place backend\models\place\Place */
/* @var $service backend\models\place\Service */
/* @var $model backend\models\place\Category */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if (!empty($basic_places)): ?>
    <div class="block background-white mt30 p30 row div">
        <div class="page-header">
            <h1><?php echo Yii::t('app', 'Hand Picked by Rwanda Guide') ?></h1>

            <p><?php echo Yii::t('app', 'Check out the best places. Each one is worth of visiting. Experience which you will never forget.') ?></p>
        </div>
        <div class="cards-wrapper">
            <div class="row">
                <?php foreach ($basic_places as $basic_place): $service = $basic_place->getThisPlaceHasServiceByCategory($model->id) ?>
                    <div class="col-sm-4">
                        <div class="card" data-background-image="<?php echo $basic_place->getThumbnailLogo() ?>">
                            <div class="card-label">
                                <small><?= Html::a($service->name, $service->getUrl(), ['target' => '_blank']) ?></small>
                            </div>

                            <div class="card-content">
                                <h2><?= Html::a($basic_place->name, $basic_place->getPlaceUrl(), ['target' => '_blank']) ?></h2>

                                <div class="card-meta">
                                    <i class="fa fa-map-o"></i> <?php echo $basic_place->neighborhood ?>
                                    <br><br><i class="fa fa-map-o"></i> <?php echo $basic_place->street ?>
                                </div>

                                <div class="card-rating">
                                    <?php echo $basic_place->getRatingStars() ?>
                                </div>
                                <div class="card-actions">
                                    <?php echo Html::a('', $basic_place->getPlaceUrl(), ['class' => 'fa fa-eye', 'target' => '_blank']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($basic_places) >= 6) : ?>
                <div class="row">
                    <div
                            class="col-xs-12 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
                        <a href="<?php echo Url::to(['/premium-list/' . $model->slug]) ?>"
                           class="btn btn-secondary btn-md btn-block"><?php echo Yii::t('app', 'View All') ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
