<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use unclead\widgets\TabularColumn;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'client_id')->dropDownList($clients, [
        'prompt' => Yii::t('app', 'Client'),
    ]); ?>

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
