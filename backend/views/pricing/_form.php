<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'descriptions')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'discount')->textInput() ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
            </div>
        </div>

    </div>
    <?php ActiveForm::end(); ?>

</div>
