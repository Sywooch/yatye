<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 18/02/2016
 * Time: 20:13
 * Time: 20:13
 */
/* @var $this yii\web\View */
/* @var $model common\models\Place */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\web\View;

$this->title = $model->name;
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title">
                <h1><?= Html::encode($this->title) ?></h1> <small><a href="<?php echo 'http://rwandaguide.info/place-details/' . $model->slug ?>" target="_blank"><i class="fa fa-eye"></i></a></small>
            </div>
            <div class="background-white p20">
                <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'method' => 'get']) ?>
                <div class="form-group">
                    <?= $form->field($model, 'name')->dropDownList($places, ['id' => 'place-id', 'prompt' => 'Select Place'])->label(false); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="background-white p20 mb50">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tabbable">
                            <ul id="myTab4" class="nav nav-tabs padding-12 tab-color-blue background-blue">
                                <li class="active">
                                    <a href="#home" data-toggle="tab">Home</a>
                                </li>
                                <li>
                                    <a href="#contact" data-toggle="tab">Contact</a>
                                </li>
                                <li>
                                    <a href="#gallery" data-toggle="tab">Gallery</a>
                                </li>
                                <li>
                                    <a href="#social" data-toggle="tab">Social</a>
                                </li>
                                <li>
                                    <a href="#services" data-toggle="tab">Services</a>
                                </li>

                                <li>
                                    <a href="#working-hours" data-toggle="tab">Working Hours</a>
                                </li>

                                <li>
                                    <a href="#users" data-toggle="tab">Users</a>
                                </li>

                                <li>
                                    <a href="#other-places" data-toggle="tab">Other Places</a>
                                </li>

                                <li>
                                    <a href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="panel-group drop-accordion" id="accordion" role="tablist"
                                                 aria-multiselectable="true">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingTwo">
                                                        <h4 class="panel-title">
                                                            <a class="collapse-controle collapsed"
                                                               data-toggle="collapse"
                                                               data-parent="#accordion" href="#collapseTwo"
                                                               aria-expanded="false" aria-controls="collapseTwo">
                                                                Basic Info
                                                            <span class="expand-icon-wrap"><i
                                                                    class="fa expand-icon"></i></span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="panel-collapse collapse"
                                                         role="tabpanel"
                                                         aria-labelledby="headingTwo" aria-expanded="false"
                                                         style="height: 0px;">
                                                        <div class="panel-body">

                                                            <?=
                                                            $this->render('_set_basic_info', [
                                                                'model' => $model,
                                                                'status' => (!empty($status) ? $status : []),
                                                            ])
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading tab-collapsed" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a class="collapse-controle" data-toggle="collapse"
                                                               data-parent="#accordion" href="#collapseOne"
                                                               aria-expanded="true" aria-controls="collapseOne">
                                                                Location
                                                            <span class="expand-icon-wrap"><i
                                                                    class="fa expand-icon"></i></span>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in"
                                                         role="tabpanel"
                                                         aria-labelledby="headingOne" aria-expanded="true">
                                                        <div class="panel-body">
                                                            <?=
                                                            $this->render('_set_location', [
                                                                'model' => $model,
                                                                'districts' => $districts,
                                                            ])
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="gallery">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?=
                                            $this->render('_set_gallery', [
                                                'model' => $model,
                                                'place_id' => $place_id,
                                                'gallery' => $gallery,
                                                'gallery_modal' => $gallery_modal,
                                            ])
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane" id="social">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?=
                                            $this->render('_set_social', [
                                                'model' => $model,
                                                'socialDataProvider' => $socialDataProvider,
                                                'social_types' => $social_types,
                                                'socials' => $socials,
                                            ])
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="services">
                                    <?=
                                    $this->render('_set_service', [
                                        'model' => $model,
                                        'place_service' => $place_service,
                                        'available_services' => $available_services,
                                        'serviceDataProvider' => $serviceDataProvider,
                                    ])
                                    ?>
                                </div>
                                <div class="tab-pane" id="contact">
                                    <?=
                                    $this->render('_set_address', [
                                        'model' => $model,
                                        'contacts' => $contacts,
                                        'contact_types' => $contact_types,
                                        'contactDataProvider' => $contactDataProvider,
                                    ])
                                    ?>
                                </div>

                                <div class="tab-pane" id="working-hours">
                                    <?php if (!empty($working_hours)) : ?>
                                        <?=
                                        $this->render('_working_hours', [
                                            'model' => $model,
                                            'working_hours' => $working_hours,
                                        ])
                                        ?>
                                    <?php else:?>
                                        <div class="alert alert-info">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Will be available shortly
                                        </div>
                                    <?php endif;?>
                                </div>
                                <div class="tab-pane" id="other-places">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?=
                                            $this->render('_other_places', [
                                                'model' => $model,
                                                'place_has_another' => $place_has_another,
                                                'available_other_places' => $available_other_places,
                                                'users' => $users,
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="users">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?=
                                            $this->render('_users', [
                                                'model' => $model,
                                                'user_place' => $user_place,
                                                'users' => $users,
                                                'userDataProvider' => $userDataProvider,
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <div class="row">
                                    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <?=
                                            $this->render('_settings', [
                                                'model' => $model,
                                                'profile_types' => $profile_types,
                                                'status' => $status,
                                            ])
                                            ?>
                                    	</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerJs(
    '$(document).ready(function(){
        $("#place-id").change(function(){
            var e = document.getElementById("place-id");
            var strSel =  e.options[e.selectedIndex].value;
            window.location.href="' . Yii::$app->urlManager->createUrl('/settings/?id=') . '" + strSel;
        });
    });', View::POS_READY);
?>