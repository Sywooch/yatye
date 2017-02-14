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
<?php //$tab = 'tab-';?>
<div class="card-row item" data-key="<?= $model['place_id'] ?>">
    <div class="card-row-inner">
        <div class="card-row-image"
             data-background-image="<?php echo Yii::$app->params['thumbnails'] . $model['logo'] ?>">
            <div class="card-row-label"><a href="#">
                    <small><?php echo $model['service_name'] ?></small></a>
            </div>
        </div>

        <div class="card-row-body">
            <h2 class="card-row-title"><a
                    href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model['place_slug'] ?>" target="_blank"><?php echo $model['place_name'] ?></a>
            </h2>

            <?php $data_by_ids = $this->context->accessDataByIds($model['place_id']);
            $contacts = $data_by_ids['get_place_contacts']; ?>

            <div class="panel-group drop-accordion" id="accordion" role="tablist"
                 aria-multiselectable="true">
                <?php if (!empty($contacts)): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading tab-collapsed" role="tab"
                             id="heading-<?php echo $model['place_id'] ?>">
                            <h4 class="panel-title">
                                <a class="collapse-controle" data-toggle="collapse"
                                   data-parent="#accordion"
                                   href="#collapse-<?php echo $model['place_id'] ?>" aria-expanded="true"
                                   aria-controls="collapse-<?php echo $model['place_id'] ?>">
                                    Contacts
                                    <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-<?php echo $model['place_id'] ?>"
                             class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading-<?php echo $model['place_id'] ?>"
                             aria-expanded="true">
                            <div class="panel-body">
                                <?php foreach ($contacts as $contact): ?>
                                    <?php if ($contact->type === Yii::$app->params['PHYSICAL_ADDRESS']): ?>
                                        <div class="detail-contact-address">
                                            <small>
                                                <i class="fa fa-location-arrow"></i> <a
                                                    href="#"><?php echo $contact->name ?></a>
                                            </small>

                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['PO_BOX']): ?>
                                        <div class="detail-contact-phone">
                                            <i class="fa fa-at"></i> <a
                                                href="#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['MOB_PHONE']): ?>
                                        <div class="detail-contact-phone">
                                            <i class="fa fa-mobile-phone"></i> <a
                                                href="#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['LAND_LINE']): ?>
                                        <div class="detail-contact-phone">
                                            <i class="fa fa-phone"></i> <a
                                                href="#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['FAX']): ?>
                                        <div class="detail-contact-phone">
                                            <i class="fa fa-fax"></i> <a
                                                href="#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['EMAIL']): ?>
                                        <div class="detail-contact-email">
                                            <i class="fa fa-envelope-o"></i> <a
                                                href="mailto:#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($contact->type === Yii::$app->params['WEBSITE']): ?>
                                        <div class="detail-contact-website">
                                            <i class="fa fa-globe"></i> <a
                                                href="#"><?php echo $contact->name ?></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading tab-collapsed" role="tab"
                         id="heading-<?php echo $model['place_id'] ?>">
                        <h4 class="panel-title">
                            <a class="collapse-controle" data-toggle="collapse"
                               data-parent="#accordion"
                               href="#collapse-location-<?php echo $model['place_id'] ?>"
                               aria-expanded="true"
                               aria-controls="collapse-location-<?php echo $model['place_id'] ?>">
                                Location
                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-location-<?php echo $model['place_id'] ?>"
                         class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="heading-<?php echo $model['place_id'] ?>"
                         aria-expanded="true">
                        <div class="panel-body">

                            <?php $data_by_ids = $this->context->accessDataByIds($model['place_id']);
                            $place = $data_by_ids['get_place_by_id']; ?>

                            <?php if ($place->street != null): ?>
                                <strong>Street</strong> :
                                <?php echo $place->street ?><br>

                            <?php endif;
                            if ($place->neighborhood != null): ?>
                                <strong>Neighborhood</strong> :
                                <?php echo $place->neighborhood ?><br>

                            <?php endif;
                            if ($place->province_id != null): ?>
                                <strong>Province</strong> :
                                <?php echo $place->getProvinceName() ?><br>

                            <?php endif;
                            if ($place->district_id != null): ?>
                                <strong>District</strong> :
                                <?php echo $place->getDistrictName() ?><br>
                            <?php endif;
                            if ($place->sector_id != null): ?>
                                <strong>Sector</strong> :
                                <?php echo $place->getSectorName() ?><br>
                            <?php endif;
                            if ($place->cell_id != null): ?>
                                <strong>Cell</strong> :
                                <?php echo $place->getCellName() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>