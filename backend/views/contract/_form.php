<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Contract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'client_id')->dropDownList($clients, [
                'prompt' => Yii::t('app', 'Client'),
            ]); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'start_at')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', ''), 'class' => 'form-control', 'value' => date('Y-m-d')],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'end_at')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', ''), 'class' => 'form-control'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'contract_doc')->fileInput() ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'status')->dropDownList($status, [
                'prompt' => Yii::t('app', 'Status'),
            ]); ?>
        </div>
    </div>
    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
