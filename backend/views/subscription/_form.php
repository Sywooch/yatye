<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Subscription */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscription-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <?= $form->field($model, 'place')->textInput() ?>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <?= $form->field($model, 'visitor')->textInput() ?>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <?= $form->field($model, 'user')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group" style="margin-top: 30px;">
                <?php echo $form->field($model, 'place_id')->widget(Select2::classname(), [
                    'data' => $places,
                    'options' => [
                        'placeholder' => 'Select a place ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false,
                    ],
                ])->label(false); ?>
            </div>
        </div>
        <div class="col-md-2 col-lg-2">
            <div class="form-group">
                <?= $form->field($model, 'status')->textInput() ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
