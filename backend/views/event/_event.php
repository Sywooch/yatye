<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 17:26
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(); ?>
<div class="background-white p30 mb50">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $form->field($model, 'name')
                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Name')])
                ->label(false); ?>
            <?php echo $form->field($model, 'description')
                ->textarea(['maxlength' => true, 'rows' => 5, 'placeholder' => Yii::t('app', 'Description')])
                ->label(false); ?>
        </div>
        <div class="col-md-5 col-lg-5">
            <?php echo $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                'attribute' => 'start_date',
                'attribute2' => 'end_date',
                'options' => ['placeholder' => Yii::t('app', 'Start Date')],
                'options2' => ['placeholder' => Yii::t('app', 'End Date')],
                'type' => DatePicker::TYPE_RANGE,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false); ?>
            <?php echo $form->field($model, 'start_time')->widget(TimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Start Time'), 'class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'showMeridian' => false,
                    'defaultTime' => false,
                    'format' => ':ii'
                ]
            ])->label(false); ?>
            <?php echo $form->field($model, 'end_time')->widget(TimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'End Time'), 'class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'showMeridian' => false,
                    'defaultTime' => false,
                    'format' => 'hh:ii'
                ]
            ])->label(false); ?>
            <?php echo $form->field($model, 'image_file')
                ->widget(FileInput::classname(), ['options' => ['accept' => 'image/*', 'placeholder' => Yii::t('app', 'Image')]])
                ->label(false); ?>
            <?php echo $form->field($model, 'address')
                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Address')])
                ->label(false); ?>
        </div>
        <div class="col-md-7 col-lg-7">
            <input id="pac-input" class="controls form-control mb30" type="text" placeholder="Enter a location">

            <div id="map-canvas"></div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <?php echo $form->field($model, 'latitude')
                        ->textInput(['id' => 'input-latitude', 'placeholder' => Yii::t('app', 'Latitude')])
                        ->label(false); ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <?php echo $form->field($model, 'longitude')
                        ->textInput(['id' => 'input-longitude', 'placeholder' => Yii::t('app', 'Longitude')])
                        ->label(false); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group" style="margin-top: 40px;">
                <?php echo Html::submitButton('Update', ['class' => 'btn btn-primary pull-right']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
