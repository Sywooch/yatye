<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 17/07/2016
 * Time: 12:12
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\grid\GridView;

$this->title = $model->name;
?>
<div class="background-white p30">
    <h1>Add Places to <b><?= Html::encode($this->title) ?></b></h1>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <?php $form = ActiveForm::begin([
                        'action' => Url::to(['service/add-places', 'service_id' => $model->id]),
                    ]); ?>

                    <div class="form-group">

                        <?php echo $form->field($place_service, 'place_id')->widget(Select2::classname(), [
                            'data' => $available_places,
                            'options' => [
                                'placeholder' => 'Select places',

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => true,
                            ],
                        ])->label(false); ?>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Save ', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
//            'summary' => '',
            'showFooter' => true,
            'showHeader' => true,
//                'layout'=>"{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                'name',
                [
                    'label' => 'Name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->name, ['/settings', 'id' => $model->id], ['target' => '_blank']);
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete-item}',
                    'buttons' => [
                        'delete-item' => function ($url, $model) {
                            $session = Yii::$app->session;
                            $service_id = $session->get('service_id');
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/place-service/delete-item/?place_id=' . $model->id . '&service_id=' . $service_id, [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],

            'tableOptions' => ['class' => 'table mb0'],
        ]); ?>
    </div>
</div>
