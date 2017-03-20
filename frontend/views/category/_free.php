<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:04
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if (!empty($free_places)): ?>
    <div class="block background-white mt50 p30 row div">
        <div class="page-header">
            <h1>Most Recent Places</h1>

            <p>List of most recent interesting places in our directory.</p>
        </div>
        <div class="cards-simple-wrapper">
            <div id="basic-list" class="row">
                <?php foreach ($free_places as $free_place):?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card-simple" data-background-image="<?php echo $free_place->getThumbnailLogo() ?>">
                            <div class="card-simple-background">
                                <div class="card-simple-content">
                                    <h2><?php echo Html::a($free_place->name, Url::to(['/place-details/' . $free_place->slug]), ['target' => '_blank']) ?></h2>

                                    <div class="card-simple-actions">
                                        <?php echo Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), Url::to(['/place-details/' . $free_place->slug]), ['target' => '_blank']) ?>
                                    </div>
                                </div>
                                <div class="card-simple-label">
                                    <small><?php echo $free_place->getThisPlaceServiceName($model->id) ?></small>
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
                        <a href="<?php echo Url::to(['/basic-list/' . $model->slug]) ?>" class="btn btn-secondary btn-md btn-block">View all</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
