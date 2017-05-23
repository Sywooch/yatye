<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p30">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'image_file')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'type')->dropDownList($types, [
                'prompt' => Yii::t('app', 'Profile type'),
            ])->label(false); ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'period')->widget(DatePicker::classname(), [
                'attribute' => 'start_at',
                'attribute2' => 'end_at',
                'options' => ['placeholder' => Yii::t('app', 'Start')],
                'options2' => ['placeholder' => Yii::t('app', 'End')],
                'type' => DatePicker::TYPE_RANGE,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'size')->dropDownList($sizes, [
                    'prompt' => Yii::t('app', 'Select the size'),
                ]);
                ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
