<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 4:58 PM
 */
/* @var $model backend\models\place\Place */
?>
<div class="row">
    <div class="div">
        <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a class="collapse-controle"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseOne"
                           aria-expanded="true"
                           aria-controls="collapseOne">
                            <?php echo Yii::t('app', 'Basic Info'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingOne"
                     aria-expanded="true">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Name'); ?>:</td>
                                    <td><?php echo $model->name ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'About this place'); ?>:</td>
                                    <td><?php echo $model->description ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Location'); ?>:</td>
                                    <td>
                                        <?php echo Yii::t('app', 'Province'); ?>: <?php echo $model->getProvinceName() ?><br>
                                        <?php echo Yii::t('app', 'District'); ?>: <?php echo $model->getDistrictName() ?><br>
                                        <?php echo Yii::t('app', 'Sector'); ?>: <?php echo $model->getSectorName() ?><br>
                                        <?php echo Yii::t('app', 'Cell'); ?>: <?php echo $model->getCellName() ?><br>
                                        <?php echo Yii::t('app', 'Village'); ?>: <?php echo $model->village_id ?><br>
                                        <?php echo Yii::t('app', 'Neighborhood'); ?>: <?php echo $model->neighborhood ?><br>
                                        <?php echo Yii::t('app', 'Street'); ?>: <?php echo $model->street ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Coordinates'); ?>:</td>
                                    <td>
                                        <?php echo Yii::t('app', 'Latitude'); ?>: <?php echo $model->latitude ?><br>
                                        <?php echo Yii::t('app', 'Longitude'); ?>: <?php echo $model->longitude ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Created At'); ?>:</td>
                                    <td><?php echo $model->created_at ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo Yii::t('app', 'Created By'); ?>:</td>
                                    <td><?php echo $model->getUser() ?></td>
                                </tr>

                                <tr>
                                    <td><?php echo Yii::t('app', 'Status'); ?>:</td>
                                    <td><?php echo $model->getStatus(); ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapse-controle collapsed"
                           data-toggle="collapse"
                           data-parent="#accordion" href="#collapseTwo"
                           aria-expanded="false"
                           aria-controls="collapseTwo">
                            <?php echo Yii::t('app', 'Contacts'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingTwo"
                     aria-expanded="false"
                     style="height: 0px;">
                    <div class="panel-body">
                        <?php echo $this->render('@backend/views/settings/_set_address', [
                            'model' => $model,
                            'contacts' => $contacts,
                            'contact_types' => $contact_types,
                            'contactDataProvider' => $contactDataProvider,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed collapse-controle"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseThree"
                           aria-expanded="false"
                           aria-controls="collapseThree">
                            <?php echo Yii::t('app', 'Gallery'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingThree"
                     aria-expanded="false">
                    <div class="panel-body">
                        <?php echo $this->render('@backend/views/settings/_set_gallery', [
                            'place_id' => $place_id,
                            'gallery' => $gallery,
                            'gallery_modal' => $gallery_modal,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                        <a class="collapsed collapse-controle"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseFour"
                           aria-expanded="false"
                           aria-controls="collapseFour">
                            <?php echo Yii::t('app', 'Social Media'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseFour"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingFour"
                     aria-expanded="false">
                    <div class="panel-body">
                        <?php echo $this->render('@backend/views/settings/_set_social', [
                            'model' => $model,
                            'socialDataProvider' => $socialDataProvider,
                            'social_types' => $social_types,
                            'socials' => $socials,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingFive">
                    <h4 class="panel-title">
                        <a class="collapsed collapse-controle"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseFive"
                           aria-expanded="false"
                           aria-controls="collapseFive">
                            <?php echo Yii::t('app', 'Services'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseFive"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingFive"
                     aria-expanded="false">
                    <div class="panel-body">
                        <?php echo $this->render('@backend/views/settings/_set_service', [
                            'model' => $model,
                            'serviceDataProvider' => $serviceDataProvider,
                            'place_has_service' => $place_has_service,
                            'available_services' => $available_services,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingSix">
                    <h4 class="panel-title">
                        <a class="collapsed collapse-controle"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseSix"
                           aria-expanded="false"
                           aria-controls="collapseSix">
                            <?php echo Yii::t('app', 'Working Hours'); ?>
                            <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="collapseSix"
                     class="panel-collapse collapse"
                     role="tabpanel"
                     aria-labelledby="headingSix"
                     aria-expanded="false">
                    <div class="panel-body">
                        <?php if (!empty($working_hours)) : ?>
                            <?php echo $this->render('@backend/views/settings/_working_hours', [
                                'model' => $model,
                                'working_hours' => $working_hours,
                            ]) ?>
                        <?php else:?>
                            <div class="alert alert-info">
                                <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <?php echo Yii::t('app', 'Will be available shortly'); ?>
                            </div>
                        <?php endif;?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
