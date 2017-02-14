<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="background-white p30">
<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Select category'])?>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <?php echo $form->field($model, 'type')->dropDownList($types, [
                    'prompt' => Yii::t('app', 'Select a type'),
                ]); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create new place' : 'Update ' . $model->name, ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
