<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */
/* @var $model backend\models\place\Place */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card-row  div p30" data-key="<?= $model->id ?>">
    <div class="card-row-inner">
        <a href="<?php echo $model->getPlaceUrl() ?>" target="_blank">
            <div class="card-row-image" data-background-image="<?php echo $model->getThumbnailLogo() ?>"></div>
        </a>
        <div class="card-row-body" style="padding: 5px;">
            <div class="card-row-properties" style="padding: 5px;">
                <h2 class="card-row-title">
                    <a href="<?php echo $model->getPlaceUrl() ?>" target="_blank">
                        <?php echo $model->name ?>
                    </a>
                </h2>

                <dl>
                    <?php if ($model->street != null): ?>
                        <dd><small><?php echo Yii::t('app', 'Street'); ?></small></dd>
                        <dt><small><?php echo $model->street ?></small></dt>
                    <?php endif;  if ($model->neighborhood != null): ?>
                        <dd><small><?php echo Yii::t('app', 'Neighborhood'); ?></small></dd>
                        <dt><small><?php echo $model->neighborhood ?></small></dt>
                    <?php endif;  if ($model->district_id != null): ?>
                        <dd><small><?php echo Yii::t('app', 'District'); ?></small></dd>
                        <dt><small><?php echo $model->getDistrictName() ?></small></dt>
                    <?php endif;  if ($model->sector_id != null): ?>
                        <dd><small><?php echo Yii::t('app', 'Sector'); ?></small></dd>
                        <dt><small><?php echo $model->getSectorName() ?></small></dt>
                    <?php endif;  if ($model->cell_id != null): ?>
                        <dd><small><?php echo Yii::t('app', 'Cell'); ?></small></dd>
                        <dt><small><?php echo $model->getCellName() ?></small></dt>
                    <?php endif; ?>
                </dl>
            </div>
        </div>
    </div>
</div>