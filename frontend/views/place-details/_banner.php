<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 9:02 PM
 */
?>
<div class="mt-80 mb50">
    <div class="detail-banner" style="background-image: url(<?php echo $model->getPhoto() ?>);">
        <div class="container">
            <div class="detail-banner-left">
                <div class="detail-banner-info">
<!--                    <div class="detail-label">Restaurant</div>-->
<!--                    <div class="detail-verified">Verified</div>-->
                </div>

                <h2 class="detail-title">
                    <?php echo $model->name ?>
                </h2>

                <div class="detail-banner-address">
                    <i class="fa fa-map-o"></i> <?php echo $model->street ?>, <?php echo $model->neighborhood ?>
                </div>

                <div class="detail-banner-rating">
                    <?php echo $model->getRatingStars()?>
                </div>
            </div>
        </div>
    </div>
</div>
