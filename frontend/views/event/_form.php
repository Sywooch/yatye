<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="background-white p30 mb30">
        <h3 class="page-title"><?php echo Yii::t('app', 'Event Attributes'); ?></h3>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo $form->field($model, 'name')
                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Name')])
                    ->label(false) ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo $form->field($model, 'image_file')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*', 'placeholder' => Yii::t('app', 'Image')],
                ])->label(false); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo $form->field($model, 'description')
                    ->textarea(['maxlength' => true, 'rows' => 5, 'placeholder' => Yii::t('app', 'Description')])
                    ->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <?php echo $form->field($model, 'start_time')->widget(TimePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'Start Time'), 'class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                        'defaultTime' => '00:00',
                        'format' => 'hh:ii'
                    ]
                ])->label(false); ?>
            </div>
            <div class="col-md-6 col-lg-6">
                <?php echo $form->field($model, 'end_time')->widget(TimePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'End Time'), 'class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'showMeridian' => false,
                        'defaultTime' => '23:59',
                        'format' => 'hh:ii'
                    ]
                ])->label(false); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="background-white p30 mb30">
                <h2 class="page-title"><?php echo Yii::t('app', 'Event Location'); ?></h2>

                <input id="pac-input" class="controls form-control mb30" type="text" placeholder="Enter a location">
                <div id="map-canvas"></div>

                <div class="row">
                    <div class="col-sm-6">
                        <?php echo $form->field($model, 'latitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])
                            ->textInput(['id' => 'input-latitude', 'placeholder' => Yii::t('app', 'Latitude')]) ?>
                    </div>

                    <div class="col-sm-6">
                        <?php echo $form->field($model, 'longitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])
                            ->textInput(['id' => 'input-longitude', 'placeholder' => Yii::t('app', 'Longitude')]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <?php echo $form->field($model, 'address', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-o"></i></span>{input}</div>',])
                            ->textInput(['maxlength' => true, 'id' => 'street', 'placeholder' => Yii::t('app', 'Address')]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="center">
        <div class="form-group">
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary btn-xl' : 'btn btn-primary btn-xl']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>