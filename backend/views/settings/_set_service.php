<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 20/02/2016
 * Time: 14:12
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\grid\GridView;

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php $form = ActiveForm::begin([
            'action' => Url::to([(Yii::$app->controller->id =='settings') ? 'settings/add-services' : 'place/add-services', 'place_id' => $model->id]),
        ]); ?>

        <div class="form-group">
            <?php echo $form->field($place_service, 'service_id')->widget(Select2::classname(), [
                'data' => $available_services,
                'options' => [
                    'placeholder' => 'Select services',

                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ])->label(false); ?>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Add Service', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="table-responsive">
            <?php echo GridView::widget([
                'dataProvider' => $serviceDataProvider,
                'layout' => '{items}{pager}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'category_name',
                        'label' => Yii::t('app', 'Service Category'),
                    ],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('app', 'Service'),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{status}',
                        'buttons' => [
                            'status' => function ($url, $model) {
                                return Html::a(Html::tag('i', '',
                                    ['class' => 'fa fa-trash']),
                                    (Yii::$app->controller->id == 'settings') ?
                                        Yii::$app->request->baseUrl . '/settings/delete-item/?service_id=' . $model['id'] . '&place_id=' . $model['place_id'] :
                                        Yii::$app->request->baseUrl . '/place/delete-item/?service_id=' . $model['id'] . '&place_id=' . $model['place_id'],
                                    [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]
                                );
                            },
                        ],
                    ],
                ],
                'tableOptions' => ['class' => 'table mb0'],
            ]); ?>
        </div>
    </div>
</div>