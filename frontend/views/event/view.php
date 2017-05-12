<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['/event/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb50">
                <h3 class="page-title">
                    <?php echo Html::encode($this->title); ?>
                    <?= Html::a('Add', ['create'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                </h3>
                <div class="panel-body">
                    <?php echo $this->render('_panel', [
                        'model' => $model,
                        'contacts' => $contacts,
                        'contact_types' => $contact_types,
                        'contactDataProvider' => $contactDataProvider,

                        'socialDataProvider' => $socialDataProvider,
                        'social_types' => $social_types,
                        'socials' => $socials,

                        'tagDataProvider' => $tagDataProvider,
                        'event_has_tags' => $event_has_tags,
                        'tags' => $tags,
                    ]) ?>
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
