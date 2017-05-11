<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/11/17
 * Time: 5:19 PM
 */

?>

<div class="tab-content">
    <div class="tab-pane active" id="home">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapse-controle collapsed" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Basic Info<span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <?php echo $this->render('_set_basic_info', [
                                    'model' => $model,
                                    'status' => (!empty($status) ? $status : []),
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading tab-collapsed" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Location<span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne"
                             aria-expanded="true">
                            <div class="panel-body">
                                <?php echo $this->render('_set_location', [
                                    'model' => $model,
                                    'districts' => $districts,
                                ]) ?>
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
                <?php echo $this->render('_set_gallery', [
                    'model' => $model,
                    'place_id' => $place_id,
                    'gallery' => $gallery,
                    'gallery_modal' => $gallery_modal,
                ]) ?>
            </div>
        </div>

    </div>

    <div class="tab-pane" id="social">

        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->render('_set_social', [
                    'model' => $model,
                    'socialDataProvider' => $socialDataProvider,
                    'social_types' => $social_types,
                    'socials' => $socials,
                ]) ?>
            </div>
        </div>

    </div>
    <div class="tab-pane" id="services">
        <?php echo $this->render('_set_service', [
            'model' => $model,
            'place_service' => $place_service,
            'available_services' => $available_services,
            'serviceDataProvider' => $serviceDataProvider,
        ]) ?>
    </div>
    <div class="tab-pane" id="contact">
        <?php echo $this->render('_set_address', [
            'model' => $model,
            'contacts' => $contacts,
            'contact_types' => $contact_types,
            'contactDataProvider' => $contactDataProvider,
        ]) ?>
    </div>

    <div class="tab-pane" id="working-hours">
        <?php if (!empty($working_hours)) : ?>
            <?php echo $this->render('_working_hours', [
                'model' => $model,
                'working_hours' => $working_hours,
            ]) ?>
        <?php else: ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Will be available shortly
            </div>
        <?php endif; ?>
    </div>
    <div class="tab-pane" id="other-places">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->render('_other_places', [
                    'model' => $model,
                    'place_has_another' => $place_has_another,
                    'available_other_places' => $available_other_places,
                    'users' => $users,
                ]) ?>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="users">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $this->render('_users', [
                    'model' => $model,
                    'user_place' => $user_place,
                    'users' => $users,
                    'userDataProvider' => $userDataProvider,
                ]) ?>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="settings">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo $this->render('_settings', [
                    'model' => $model,
                    'profile_types' => $profile_types,
                    'status' => $status,
                ]) ?>
            </div>
        </div>
    </div>
</div>
