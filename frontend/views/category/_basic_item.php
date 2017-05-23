<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/18/17
 * Time: 3:07 PM
 */
/* @var $model backend\models\place\Place */
/* @var $service backend\models\place\Service */

$session = Yii::$app->session;
$category_id = $session->get('category_id');
$service = $model->getThisPlaceHasServiceByCategory($category_id)
?>
<div class="col-sm-4 item" data-key="<?= $model->id ?>">
    <div class="card" data-background-image="<?php echo $model->getThumbnailLogo() ?>">
        <div class="card-label">
            <a href="<?php echo $service->getUrl() ?>"><?php echo $service->name ?></a>
        </div>

        <div class="card-content">
            <h2><a href="<?php echo $model->getPlaceUrl() ?>" target="_blank"><?php echo $model->name ?></a></h2>

            <div class="card-meta">
                <i class="fa fa-map-o"></i> <?php echo $model->street ?>
            </div>

            <div class="card-rating">
                <?php echo $model->getRatingStars() ?>
            </div>

            <div class="card-actions">
                <a href="<?php echo $model->getPlaceUrl() ?>" target="_blank"><i class="fa fa-eye"></i></a>
            </div>
        </div>
    </div>
</div>

