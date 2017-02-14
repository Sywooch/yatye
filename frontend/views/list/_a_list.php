<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/02/2016
 * Time: 19:42
 * @var $this yii\web\View
 */
use yii\widgets\LinkPager;

?>

<div class="cards-row">
    <?php if (!empty($services)): ?>
        <?php foreach ($services as $service): ?>
            <div class="card-row">
                <div class="card-row-inner">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>"><div class="card-row-image" data-background-image="<?php echo Yii::$app->params['thumbnails'] . $service['logo'] ?>"></div></a>
                    <div class="card-row-body" style="padding: 5px;">
                        <div class="card-row-properties" style="padding: 5px;">
                            <h2 class="card-row-title"><a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>"><?php echo $service['place_name'] ?></a></h2>
                            <?php $place = $model->getPlaceById($service['place_id']); ?>
                            <dl>
                                <?php if ($place->street != null): ?>
                                    <dd><small>Street</small></dd>
                                    <dt><small><?php echo $place->street ?></small></dt>
                                <?php endif;  if ($place->neighborhood != null): ?>
                                    <dd><small>Neighborhood</small></dd>
                                    <dt><small><?php echo $place->neighborhood ?></small></dt>
                                <?php /*endif;  if ($place->province_id != null): */?><!--
                                    <dd><small>Province</small></dd>
                                    <dt><small><?php /*echo $place->getProvinceName() */?></small></dt>-->
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
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Welcome to Rwanda Guide! </strong><?php echo Yii::$app->params['missing_message'] ?>
        </div>
    <?php endif; ?>
</div>
<div class="pager">
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>


