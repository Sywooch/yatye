<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/01/2017
 * Time: 21:17
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use yii\grid\GridView;
$this->title = 'Add pricing item';
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <!--        --><?php //$form = ActiveForm::begin([
        ////            'action' => Url::to(['pricing/add-pricing-item', 'pricing_id' => $model->id]),
        //        ]); ?>
        <!---->
        <!--        <div class="form-group">-->
        <!--            --><?php //echo $form->field($model, 'pricing_item_id')->widget(Select2::classname(), [
        //                'data' => $pricing_items,
        //                'options' => [
        //                    'placeholder' => 'Select pricing items',
        //
        //                ],
        //                'pluginOptions' => [
        //                    'allowClear' => true,
        //                    'multiple' => true,
        //                ],
        //            ])->label(false); ?>
        <!---->
        <!--        </div>-->
        <!---->
        <!--        <div class="form-group">-->
        <!--            --><?php //echo Html::submitButton('Add Pricing Item', ['class' => 'btn btn-primary pull-right']) ?>
        <!--        </div>-->
        <!--        --><?php //ActiveForm::end(); ?>

        <?php $form = ActiveForm::begin(); ?>
        <?php echo TabularInput::widget([
            'models' => $models,
            'attributeOptions' => [
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'validateOnChange' => false,
                'validateOnSubmit' => true,
                'validateOnBlur' => false,
            ],
            'addButtonOptions' => [
                'class' => 'btn btn-secondary',
            ],
            'columns' => [
                [
                    'name' => 'pricing_item_id',
                    'title' => 'Pricing item',
                    'type' => 'dropDownList',
                    'items' => $pricing_items,
                ],
                [
                    'name' => 'descriptions',
                    'title' => 'Descriptions',
                    'type' => MultipleInputColumn::TYPE_TEXT_INPUT,
                ],
            ],
        ]) ?>
        <?php echo Html::submitButton('Add Pricing Item', ['class' => 'btn btn-primary pull-right']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="table-responsive">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items}{pager}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'descriptions',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => 'fa fa-trash']), Url::to(['pricing/delete-item', 'pricing_id' => $model['pricing_id'], 'pricing_item_id' => $model['id']]), [
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
</div>
