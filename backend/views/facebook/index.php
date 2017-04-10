<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Facebook Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30 row">

    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="panel">
            <div class="panel-heading">
                <a class="btn btn-primary btn btn-primary btn-xs pull-right" data-toggle="modal" href="#modal-id"><i
                            class="fa fa-download"></i></a>
            </div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'event_id',
                        [
                            'label' => 'Name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(substr($model->name, 0, 50), ['update', 'id' => $model->id], ['target' => '_blank']);
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {status} {save}',
                            'buttons' => [

                                'view' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url,
                                        ['class' => 'btn btn-secondary btn-xs']);
                                },
                                'status' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => ($model->status == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/facebook/status/?id=' . $model->id, [
                                        'class' => 'btn btn-danger btn-xs',
                                    ]);
                                },

                                'save' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-save']), Yii::$app->request->baseUrl . '/facebook/save/?id=' . $model->id, [
                                        'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                            ],
                        ],
                    ],
                    'tableOptions' => ['class' => 'table mb0'],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['action' => Url::to(['import'])]); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo Yii::t('app', 'Graph API set up')?></h4>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'endpoints')->textInput(['maxlength' => true, 'value' => 'search?q=Kigali&type=event']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>