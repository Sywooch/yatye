<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/12/17
 * Time: 5:15 PM
 */
/* @var $model backend\models\Event */
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
                            <?php echo Yii::t('app', 'Event Info'); ?>
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
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                            <?php if($model->banner != null): ?>
                                <img class="img-responsive thumbnail" alt=""
                                     src="<?php echo Yii::$app->params['event_images'] . $model->banner ?>"/>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="table-responsive">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td><?php echo Yii::t('app', 'Name'); ?>:</td>
                                        <td><?php echo $model->name ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Yii::t('app', 'About This Event'); ?>:</td>
                                        <td><?php echo $model->description ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo Yii::t('app', 'Address'); ?>:</td>
                                        <td><?php echo $model->address ?></td>
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
                                        <td><?php echo Yii::t('app', 'Status'); ?>: </td>
                                        <td><?php echo $model->getStatus(); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapse-controle collapsed"
                           data-toggle="collapse"
                           data-parent="#accordion"
                           href="#collapseTwo"
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
                        <?php echo
                        $this->render('@backend/views/event/_contact', [
                            'model' => $model,
                            'contacts' => $contacts,
                            'contact_types' => $contact_types,
                            'contactDataProvider' => $contactDataProvider,
                        ])
                        ?>
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
                        <?php echo
                        $this->render('@backend/views/event/_social', [
                            'model' => $model,
                            'socialDataProvider' => $socialDataProvider,
                            'social_types' => $social_types,
                            'socials' => $socials,
                        ])
                        ?>
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
                            <?php echo Yii::t('app', 'Tags'); ?>
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
                        <?php echo
                        $this->render('@backend/views/event/_tags', [
                            'model' => $model,
                            'tagDataProvider' => $tagDataProvider,
                            'event_has_tags' => $event_has_tags,
                            'tags' => $tags,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
