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
                <h1><?php echo Html::encode($this->title) ?></h1> <small><a href="<?php echo 'http://rwandaguide.info/place-details/' . $model->slug ?>" target="_blank"><i class="fa fa-eye"></i></a></small>
            </div>
            <div class="background-white p20">
                <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'method' => 'get']) ?>
                <div class="form-group">
                    <?php echo $form->field($model, 'name')->dropDownList($places, ['id' => 'place-id', 'prompt' => 'Select Place'])->label(false); ?>
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

                                <!--<li>
                                    <a href="#other-places" data-toggle="tab">Other Places</a>
                                </li>-->

                                <li>
                                    <a href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>

                            <?php echo $this->render('_tab_content', [
                                'model' => $model,
                                'profile_types' => $profile_types,
                                'status' => $status,
                                'districts' => $districts,
                                'place_id' => $place_id,
                                'gallery' => $gallery,
                                'gallery_modal' => $gallery_modal,
                                'socialDataProvider' => $socialDataProvider,
                                'social_types' => $social_types,
                                'socials' => $socials,
                                'place_has_service' => $place_has_service,
                                'available_services' => $available_services,
                                'serviceDataProvider' => $serviceDataProvider,
                                'contacts' => $contacts,
                                'contact_types' => $contact_types,
                                'contactDataProvider' => $contactDataProvider,
                                'working_hours' => $working_hours,
                                'place_has_another' => $place_has_another,
                                'available_other_places' => $available_other_places,
                                'users' => $users,
                                'user_place' => $user_place,
                                'userDataProvider' => $userDataProvider,
                            ]) ?>
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