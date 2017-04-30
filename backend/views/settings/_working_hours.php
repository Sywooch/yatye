<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/10/2016
 * Time: 17:27
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use kartik\widgets\TimePicker;
?>
<div class="background-white p20 mb50">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php $form = ActiveForm::begin([
                'action' => Url::to([(Yii::$app->controller->id == 'settings') ? 'settings/set-working-hours' : 'place/set-working-hours', 'place_id' => $model->id]),
                'id' => 'add-contact',
            ]); ?>
            <?= TabularInput::widget([
                'models' => $working_hours,
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
                        'name' => 'day',
                        'title' => 'Day',
                        'options' => [
                            'disabled'=>'disabled',
                        ],
                    ],
                    [
                        'name' => 'opening_time',
                        'title' => 'Opening Time',
                        'type' => TimePicker::className(),
                        'options' => [
                            'pluginOptions' => [
                                'showSeconds' => false,
                                'showMeridian' => false,
                                'minuteStep' => 15,
                            ]
                        ],
                    ],
                    [
                        'name' => 'closing_time',
                        'title' => 'Closing Time',
                        'type' => TimePicker::className(),
                        'options' => [
                            'pluginOptions' => [
                                'showSeconds' => false,
                                'showMeridian' => false,
                                'minuteStep' => 15,
                            ]
                        ],
                    ],

                    [
                        'name'  => 'closed',
                        'type'  => 'dropDownList',
                        'title' => 'Closed Day',
                        'defaultValue' => 'no',
                        'items' => [
                            'no' => 'No',
                            'yes' => 'Yes'
                        ]
                    ],
                ],
            ]) ?>
            <?php echo Html::submitButton('Save Working Hours', ['class' => 'btn btn-primary pull-right']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>