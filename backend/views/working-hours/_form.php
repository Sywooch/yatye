<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\TimePicker;
/* @var $this yii\web\View */
/* @var $model common\models\WorkingHours */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">
    <div class="row">
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE]); ?>
        <div class="form-group">
            <?php echo $form->field($model, 'opening_time')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 15,
                    'defaultTime' => 'current',
                ],
            ]); ?>
        </div>
        <div class="form-group">
            <?php echo $form->field($model, 'closing_time')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 15,
                    'defaultTime' => 'current',
                ],
            ]); ?>
        </div>
        <div class="form-group">
            <?php echo $form->field($model, 'closed')->dropDownList(['no' => 'No', 'yes' => 'Yes',], ['prompt' => '']) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
