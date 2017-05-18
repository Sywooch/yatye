<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */
/* @var $model backend\models\place\Place */
/* @var $service backend\models\place\Service */
use yii\helpers\Html;
use yii\helpers\Url;
$session = Yii::$app->session;
$category_id = $session->get('category_id');
$service = $model->getThisPlaceHasService($category_id)
?>
<div class="card-row item div" data-key="<?= $model->id ?>">
    <div class="card-row-inner">
        <div class="card-row-image" data-background-image="<?php echo $model->getThumbnailLogo() ?>">
            <div class="card-row-label">
                <a href="<?php echo $service->getUrl() ?>">
                    <small><?php echo $service->name ?></small>
                </a>
            </div>
            <div class="card-row-price" style="background-color: transparent;">
                <div class="card-row-rating">
                    <?php echo $model->getRatingStars() ?>
                </div>
            </div>

        </div>

        <div class="card-row-body">
            <h2 class="card-row-title">
                <a href="<?php echo $model->getPlaceUrl() ?>" target="_blank"><?php echo $model->name ?></a>
            </h2>

            <?php $contacts = $this->context->getPlaceContacts($model->id); ?>

            <div class="panel-group drop-accordion" id="accordion" role="tablist"
                 aria-multiselectable="true">
                <?php if (!empty($contacts)): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading tab-collapsed" role="tab"
                             id="heading-<?php echo $model->id ?>">
                            <h4 class="panel-title">
                                <a class="collapse-controle" data-toggle="collapse"
                                   data-parent="#accordion"
                                   href="#collapse-<?php echo $model->id ?>" aria-expanded="true"
                                   aria-controls="collapse-<?php echo $model->id ?>">Contacts
                                    <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-<?php echo $model->id ?>"
                             class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading-<?php echo $model->id ?>"
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
                         id="heading-<?php echo $model->id ?>">
                        <h4 class="panel-title">
                            <a class="collapse-controle" data-toggle="collapse"
                               data-parent="#accordion"
                               href="#collapse-location-<?php echo $model->id ?>"
                               aria-expanded="true"
                               aria-controls="collapse-location-<?php echo $model->id ?>">
                                Location
                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-location-<?php echo $model->id ?>"
                         class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="heading-<?php echo $model->id ?>"
                         aria-expanded="true">
                        <div class="panel-body">
                            <?php if ($model->street != null): ?>
                                <strong>Street</strong> :
                                <?php echo $model->street ?><br>

                            <?php endif;
                            if ($model->neighborhood != null): ?>
                                <strong>Neighborhood</strong> :
                                <?php echo $model->neighborhood ?><br>

                            <?php endif;
                            if ($model->province_id != null): ?>
                                <strong>Province</strong> :
                                <?php echo $model->getProvinceName() ?><br>

                            <?php endif;
                            if ($model->district_id != null): ?>
                                <strong>District</strong> :
                                <?php echo $model->getDistrictName() ?><br>
                            <?php endif;
                            if ($model->sector_id != null): ?>
                                <strong>Sector</strong> :
                                <?php echo $model->getSectorName() ?><br>
                            <?php endif;
                            if ($model->cell_id != null): ?>
                                <strong>Cell</strong> :
                                <?php echo $model->getCellName() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>