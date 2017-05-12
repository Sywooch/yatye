<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:04
 */
/* @var $free_place backend\models\place\Place */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if (!empty($free_places)): ?>
<div class="block background-white mt30 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Most Recent Places') ?></h1>

        <p><?php echo Yii::t('app', 'List of most recent interesting places in our directory.') ?></p>
    </div>
    <div class="cards-simple-wrapper">
        <div id="basic-list" class="row">
            <?php foreach ($free_places as $free_place):?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card-simple" data-background-image="<?php echo $free_place->getThumbnailLogo() ?>">
                        <div class="card-simple-background">
                            <div class="card-simple-content">
                                <h2><?php echo Html::a($free_place->name, $free_place->getPlaceUrl(), ['target' => '_blank']) ?></h2>
                                <div class="card-simple-rating">
                                    <?php echo $free_place->getRatingStars() ?>
                                </div>
                                <div class="card-simple-actions">
                                    <?php echo Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $free_place->getPlaceUrl(), ['target' => '_blank']) ?>
                                </div>
                            </div>
                            <div class="card-simple-label">
                                <small><?php echo $free_place->getThisPlaceHasServiceName($model->id) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($free_places) >= 16) : ?>
            <div class="row">
                <div
                        class="col-xs-12 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
                    <a href="<?php echo Url::to(['/basic-list/' . $model->slug]) ?>"
                       class="btn btn-secondary btn-md btn-block"><?php echo Yii::t('app', 'View All') ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>