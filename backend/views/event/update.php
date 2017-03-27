<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use yii\web\View;
use kartik\widgets\Typeahead;
use kartik\widgets\Select2;



/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="row">
    <div class="col-sm-12">
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
                                <a href="#social" data-toggle="tab">Social</a>
                            </li>
                            <li>
                                <a href="#tags" data-toggle="tab">Tags</a>
                            </li>
                            <li>
                                <a href="#users" data-toggle="tab">Users</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <?=
                                        $this->render('_event', [
                                            'model' => $model,
                                            'status' => $status,
                                            'profile_types' => $profile_types,
                                        ])
                                        ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="social">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <?=
                                        $this->render('_social', [
                                            'model' => $model,
                                            'socialDataProvider' => $socialDataProvider,
                                            'social_types' => $social_types,
                                            'socials' => $socials,
                                        ])
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tags">
                                <?=
                                $this->render('_tags', [
                                    'model' => $model,
                                    'tagDataProvider' => $tagDataProvider,
                                    'event_has_tags' => $event_has_tags,
                                    'tags' => $tags,
                                ])
                                ?>
                            </div>
                            <div class="tab-pane" id="contact">
                                <?=
                                $this->render('_contact', [
                                    'model' => $model,
                                    'contact_types' => $contact_types,
                                    'contacts' => $contacts,
                                    'contactDataProvider' => $contactDataProvider,
                                ])
                                ?>
                            </div>

                            <div class="tab-pane" id="users">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?=
                                        $this->render('_users', [
                                            'model' => $model,
                                            'user_event' => $user_event,
                                            'users' => $users,
                                            'userDataProvider' => $userDataProvider,
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
