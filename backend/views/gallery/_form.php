<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gallery-form">

    <?php
    $services_data = $this->context->accessDataByIds($model->category_id);
    $services = $services_data['get_services'];

    $service_data_in_array = $this->context->accessDataByIds($services);
    $services_in_array = $service_data_in_array['get_data_in_array'];

    $form = ActiveForm::begin();
    ?>


    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'category_id')->dropDownList($categories, [
                    'id' => 'category_id',
                    'prompt' => 'Select category'
                ]) ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'service_id')->widget(DepDrop::className(), [
                    'options' => ['id' => 'service_id'],
                    'data' => $services_in_array,
                    'pluginOptions' => [
                        'depends' => ['category_id'],
                        'placeholder' => Yii::t('app', 'Select a service ...'),
                        'url' => Url::to(['/gallery/services'])
                    ]
                ]); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'expire_at')->widget(DateTimePicker::classname(), [
                    'options' => ['placeholder' => 'Enter expire time ...'],
                    'pluginOptions' => [
                        'autoclose' => false
                    ]
                ]); ?>

            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'status')->dropDownList($status, [
                    'prompt' => Yii::t('app', 'Select a status'),
                ]); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
