<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/18/17
 * Time: 3:35 PM
 */
/* @var $model backend\models\place\Place */
/* @var $service backend\models\place\Service */
use yii\helpers\Html;

$session = Yii::$app->session;
$category_id = $session->get('category_id');
$service = $model->getThisPlaceHasServiceByCategory($category_id);
$active = ' active';
?>

<div class="item_ item<?php echo ($index == 0) ? $active : ''; ?>" data-key="<?= $model->id ?>">
    <div class="item-bg" style="background-image: url(<?php echo $model->getLogo() ?>)"></div>
    <img style="width: 640px; height: 370px;"
         src="<?php echo $model->getPhoto() ?>"
         alt="<?php echo $model->name; ?>">
    <div class="carousel-caption">
        <div class="hero-slider-content">
            <h1><?php echo $model->name; ?></h1>
            <div class="hero-slider-rating">
                <?php echo $model->getRatingStars() ?>
            </div>
        </div>

        <div class="hero-slider-actions">
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']),
                $model->getPlaceUrl(),
                ['target' => '_blank']) ?>
        </div>
    </div>
</div>