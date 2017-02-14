<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 17:25
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use yii\grid\GridView;
?>
<div class="background-white p20 mb50">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['event/add-contacts', 'event_id' => $model->id]),
                'id' => 'add-contact',
            ]); ?>
            <?= TabularInput::widget([
                'models' => $contacts,
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
                        'name' => 'type',
                        'title' => 'Contact Type',
                        'type' => 'dropDownList',
                        'items' => $contact_types,
                    ],
                    [
                        'name' => 'name',
                        'title' => 'Contact',
                        'type' => MultipleInputColumn::TYPE_TEXT_INPUT,
                    ],
                ],
            ]) ?>
            <?php echo Html::submitButton('Add contact', ['class' => 'btn btn-primary pull-right']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <?php echo GridView::widget([
                    'dataProvider' => $contactDataProvider,
                    'layout' => '{items}{pager}',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'type',
                            'label' => Yii::t('app', 'Contact Type'),
                            'value' => function ($model) {
                                return $model->getContactTypes();
                            },
                        ],
                        [
                            'attribute' => 'name',
                            'label' => Yii::t('app', 'Contact'),
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '',
                                        ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/event/delete-item/?contact_id=' . $model['id'] . '&event_id=' . $model['event_id'],
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
</div>
