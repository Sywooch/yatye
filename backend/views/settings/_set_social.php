<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 20/02/2016
 * Time: 11:57
 */

/* @var $this yii\web\View */
/* @var $model common\models\Address */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\web\View;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use yii\grid\GridView;

?>
<div class="background-white p20 mb50">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php $form = ActiveForm::begin([
                'action' => Url::to([(Yii::$app->controller->id =='settings') ? 'settings/add-social-media' : 'place/add-social-media', 'place_id' => $model->id]),
            ]); ?>
            <?= TabularInput::widget([
                'models' => $socials,
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
                        'title' => 'Social Type',
                        'type' => 'dropDownList',
                        'items' => $social_types,
                    ],
                    [
                        'name' => 'name',
                        'title' => 'Social Media',
                        'type' => MultipleInputColumn::TYPE_TEXT_INPUT,
                    ],
                ],
            ]) ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary pull-right']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <?php echo GridView::widget([
                    'dataProvider' => $socialDataProvider,
                    'layout' => '{items}{pager}',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'type',
                            'label' => Yii::t('app', 'Social Type'),
                            'value' => function ($model) {
                                return $model->getSocialTypes();
                            },
                        ],
                        [
                            'label' => 'Name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return substr($model->name, 0, 80);
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{status}',
                            'buttons' => [
                                'status' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '',
                                        ['class' => 'fa fa-trash']),
                                        (Yii::$app->controller->id == 'settings') ?
                                            Yii::$app->request->baseUrl . '/settings/delete-item/?social_id=' . $model['id'] . '&place_id=' . $model['place_id'] :
                                            Yii::$app->request->baseUrl . '/place/delete-item/?social_id=' . $model['id'] . '&place_id=' . $model['place_id'],
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


