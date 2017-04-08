<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-sm-6 col-lg-4 item" data-key="<?= $model->id ?>">
    <div class="card-simple" data-background-image="<?php echo $model->getBanner() ?>">
        <div class="card-simple-background">
            <div class="card-simple-content">
                <h2>
                    <a href="<?php echo $model->getEventUrl() ?>" target="_blank"><?php echo $model->name ?></a>
                </h2>

                <?php if ($model->address != null): ?>
                    <div class="card-meta">
                        <i class="fa fa-map-o"></i> <?php echo $model->address ?>
                    </div>
                <?php endif; ?>

                <div class="card-simple-actions">
                    <a href="<?php echo $model->getEventUrl() ?>" target="_blank" class="fa fa-eye"></a>
                </div>
            </div>
            <div class="card-simple-label"><?php echo $model->getDate() ?></div>
            <div class="card-simple-price" style="opacity: 0.7"><small><?php echo $model->address ?></small></div>
        </div>
    </div>
</div>