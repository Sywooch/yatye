<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

use backend\assets\RwandaguideAsset;
RwandaguideAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\place\Place */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['/place/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb50">
                <div class="panel-body">
                    <h3 class="page-title">
                        <?php echo $model->name; ?>
                        <?php echo Html::a('Add', ['create'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                    </h3>
                    <?php echo $this->render('_panel', [
                        'model' => $model,
                        'contacts' => $contacts,
                        'contact_types' => $contact_types,
                        'contactDataProvider' => $contactDataProvider,

                        'place_id' => $place_id,
                        'gallery' => $gallery,
                        'gallery_modal' => $gallery_modal,

                        'socialDataProvider' => $socialDataProvider,
                        'social_types' => $social_types,
                        'socials' => $socials,

                        'serviceDataProvider' => $serviceDataProvider,
                        'place_has_service' => $place_has_service,
                        'available_services' => $available_services,

                        'working_hours' => $working_hours,
                    ]) ?>
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
