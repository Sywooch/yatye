<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = $model->name;
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li><a href="<?php echo Url::to(['/event']) ?>"><?php echo Yii::t('app', 'Events'); ?></a></li>
            <li class="active"><a href="#"><?php echo $model->name; ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb50">
                <h3 class="page-title">
                    <?php echo Html::encode($this->title); ?>
                    <?= Html::a('Add', ['create'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                </h3>
                <div class="panel-body">
                    <div class="row">
                        <div class="div">
                            <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Event Info
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
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
                                                            <td>Name:</td>
                                                            <td><?= $model->name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>About this place:</td>
                                                            <td><?= $model->description ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address:</td>
                                                            <td><?= $model->address ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Coordinates:</td>
                                                            <td>
                                                                Latitude: <?= $model->latitude ?><br>
                                                                Longitude: <?= $model->longitude ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created at:</td>
                                                            <td><?= $model->created_at ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created by:</td>
                                                            <td><?= $model->getUser() ?></td>
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
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Social Media
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                                        <div class="panel-body">
                                            <?=
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
                                            <a class="collapsed collapse-controle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Tags
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                                        <div class="panel-body">
                                            <?=
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
                </div>
                <div class="panel-footer">
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary btn-secondary']) ?>
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-eye']), Url::to(['upcoming-event/' . $model->slug]), ['target'=>'_blank', 'class' => 'btn btn-sm btn-primary btn-secondary']) ?>
                    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-remove']), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
