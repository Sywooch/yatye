<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */

?>
<div class="card-row" data-key="<?= $model['place_id'] ?>">
    <div class="card-row-inner">
        <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model['place_slug'] ?>">
            <div class="card-row-image" data-background-image="<?php echo Yii::$app->params['thumbnails'] . $model['logo'] ?>"></div>
        </a>
        <div class="card-row-body" style="padding: 5px;">
            <div class="card-row-properties" style="padding: 5px;">
                <h2 class="card-row-title"><a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model['place_slug'] ?>"><?php echo $model['place_name'] ?></a></h2>
                <?php $data_by_ids = $this->context->accessDataByIds($model['place_id']);
                $place = $data_by_ids['get_place_by_id']; ?>
                <dl>
                    <?php if ($place->street != null): ?>
                        <dd><small>Street</small></dd>
                        <dt><small><?php echo $place->street ?></small></dt>
                    <?php endif;  if ($place->neighborhood != null): ?>
                        <dd><small>Neighborhood</small></dd>
                        <dt><small><?php echo $place->neighborhood ?></small></dt>
                    <?php endif;  if ($place->district_id != null): ?>
                        <dd><small>District</small></dd>
                        <dt><small><?php echo $place->getDistrictName() ?></small></dt>
                    <?php endif;  if ($place->sector_id != null): ?>
                        <dd><small>Sector</small></dd>
                        <dt><small><?php echo $place->getSectorName() ?></small></dt>
                    <?php endif;  if ($place->cell_id != null): ?>
                        <dd><small>Cell</small></dd>
                        <dt><small><?php echo $place->getCellName() ?></small></dt>
                    <?php endif; ?>
                </dl>
            </div>
        </div>
    </div>
</div>