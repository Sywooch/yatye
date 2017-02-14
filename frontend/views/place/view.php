<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

use backend\assets\RwandaguideAsset;
RwandaguideAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\Place */

$this->title = $model->name;
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li><a href="<?php echo Url::to(['/event']) ?>"><?php echo Yii::t('app', 'Places'); ?></a></li>
            <li class="active"><a href="#"><?php echo $model->name; ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb50">
                <div class="panel-body">
                    <div class="row">
                        <div class="div">
                            <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Basic Info
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-user-information">
                                                    <tbody>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td><?= $model->name ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>About this place:</td>
                                                        <td><?= $model->description ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Link:</td>
                                                        <td><?= $model->slug ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location:</td>
                                                        <td>
                                                            Province: <?= $model->getProvinceName() ?><br>
                                                            District: <?= $model->getDistrictName() ?><br>
                                                            Sector: <?= $model->getSectorName() ?><br>
                                                            Cell: <?= $model->getCellName() ?><br>
                                                            Village: <?= $model->village_id ?><br>
                                                            Neighborhood: <?= $model->neighborhood ?><br>
                                                            Street: <?= $model->street ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Coordinates:</td>
                                                        <td>
                                                            Latitude: <?= $model->latitude ?><br>
                                                            Longitude: <?= $model->longitude ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created_at:</td>
                                                        <td><?= $model->created_at ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Created_by:</td>
                                                        <td><?= $model->getUser($model->created_by) ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td> Status: </td>
                                                        <td>
                                                            <?php

                                                            if($model->status == Yii::$app->params['inactive']):
                                                                echo 'Inactive';
                                                            elseif($model->status == Yii::$app->params['active']):
                                                                echo 'Active';
                                                            elseif($model->status == Yii::$app->params['pending']):
                                                                echo 'Pending';
                                                            elseif($model->status == Yii::$app->params['rejected']):
                                                                echo 'Rejected';
                                                            else:
                                                                echo 'Inactive';
                                                            endif;

                                                            ?>
                                                        </td>
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
                                            <a class="collapse-controle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Contacts
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <?=
                                            $this->render('@backend/views/settings/_set_address', [
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
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Gallery
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                                        <div class="panel-body">
                                            <?= $this->render('@backend/views/settings/_set_gallery', [
                                                'place_id' => $place_id,
                                                'gallery' => $gallery,
                                                'gallery_modal' => $gallery_modal,])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Social Media
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                                        <div class="panel-body">
                                            <?=
                                            $this->render('@backend/views/settings/_set_social', [
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
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Services
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                                        <div class="panel-body">
                                            <?=
                                            $this->render('@backend/views/settings/_set_service', [
                                                'model' => $model,
                                                'serviceDataProvider' => $serviceDataProvider,
                                                'place_service' => $place_service,
                                                'available_services' => $available_services,
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSix">
                                        <h4 class="panel-title">
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                Working Hours
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" aria-expanded="false">
                                        <div class="panel-body">
                                            <?php if (!empty($working_hours)) : ?>
                                                <?=
                                                $this->render('@backend/views/settings/_working_hours', [
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary btn-secondary']) ?>
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Url::to(['place-details/' . $model->slug]), ['target'=>'_blank', 'class' => 'btn btn-sm btn-primary btn-secondary']) ?>
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
            window.location.href="' . Yii::$app->urlManager->createUrl('place/update?id=') . '" + strSel;
        });
    });', View::POS_READY);
?>
