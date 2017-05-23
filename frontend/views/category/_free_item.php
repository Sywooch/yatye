<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/18/17
 * Time: 3:28 PM
 */
/* @var $model backend\models\place\Place */
/* @var $service backend\models\place\Service */

$session = Yii::$app->session;
$category_id = $session->get('category_id');
$service = $model->getThisPlaceHasServiceByCategory($category_id)
?>

<div class="col-sm-6 col-md-3 item" data-key="<?= $model->id ?>">
    <div class="card-simple" data-background-image="<?php echo $model->getThumbnailLogo() ?>">
        <div class="card-simple-background">
            <div class="card-simple-content">
                <h2><a href="<?php echo $model->getPlaceUrl() ?>" target="_blank">
                        <?php echo $model->name ?></a></h2>
                <div class="card-simple-rating">
                    <?php echo $model->getRatingStars() ?>
                </div>

                <div class="card-simple-actions">
                    <a href="<?php echo $model->getPlaceUrl() ?>" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-simple-label"><small><?php echo $service->name ?></small></div>

            <div class="card-simple-price" style="opacity: 0.7">
                <small><?php echo $model->street ?></small>
            </div>
        </div>
    </div>
</div>
