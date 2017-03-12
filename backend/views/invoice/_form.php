<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\widgets\TabularInput;
use unclead\widgets\TabularColumn;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'client_id')->dropDownList($clients, [
                'prompt' => Yii::t('app', 'Client'),
            ]); ?>        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'type')->dropDownList($types, [
                'prompt' => Yii::t('app', 'Type'),
            ]); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'contract_id')->dropDownList($contracts, [
                'prompt' => Yii::t('app', 'Contract'),
            ]); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php echo TabularInput::widget([
        'models' => $invoice_items,
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
                'name' => 'name',
                'title' => 'Item Name',
                'type' => TabularColumn::TYPE_TEXT_INPUT,
            ],
            [
                'name' => 'quantity',
                'title' => 'Quantity',
                'type' => TabularColumn::TYPE_TEXT_INPUT,
            ],
            [
                'name' => 'unit_cost',
                'title' => 'Unit Cost',
                'type' => TabularColumn::TYPE_TEXT_INPUT,
            ],
        ],
    ]) ?>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
