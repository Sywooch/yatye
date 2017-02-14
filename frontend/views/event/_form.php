<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="background-white p30 mb30">
    <h3 class="page-title"><?php echo Yii::t('app', 'Attributes'); ?></h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 5]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label><?php echo Yii::t('app', 'Start'); ?></label>
                <?php echo $form->field($model, 'start_at')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'Start Time'), 'class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ])->label(false); ?>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label><?php echo Yii::t('app', 'End'); ?></label>
                <?php echo $form->field($model, 'end_at')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app', 'End Time'), 'class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ])->label(false); ?>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">

        <div class="background-white p30 mb30">
            <h2 class="page-title"><?php echo Yii::t('app', 'Map Position'); ?></h2>

            <input id="pac-input" class="controls form-control mb30" type="text" placeholder="Enter a location">
            <div id="map-canvas"></div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <label><?php echo Yii::t('app', 'Latitude'); ?></label>
                        <?= $form->field($model, 'latitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])->textInput(['id'=>'input-latitude']) ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="input-group">
                        <label><?php echo Yii::t('app', 'Longitude'); ?></label>
                        <?= $form->field($model, 'longitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])->textInput(['id'=>'input-longitude']) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <label><?php echo Yii::t('app', 'Street'); ?></label>
                        <?= $form->field($model, 'address', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-o"></i></span>{input}</div>',])->textInput(['maxlength' => true, 'id'=>'street']) ?>
                    </div><!-- /.form-group -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="center">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary btn-xl' : 'btn btn-primary btn-xl']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>