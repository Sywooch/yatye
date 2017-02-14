<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget as Redactor;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\NewsLetter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'type')->dropDownList($types, [
                    'prompt' => Yii::t('app', 'Select type'),
                ]);
                ?>
            </div>
        </div>
    </div>
<!--    <div class="row">-->
<!--        <div class="col-md-6 col-lg-6">-->
<!--            <div class="form-group">-->
<!--                --><?php //echo $form->field($model, 'send_at')->widget(DateTimePicker::classname(), [
//                    'name' => 'send_at',
//                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
//                    'value' => date('Y-m-d H:i:s'),
//                    'options' => ['placeholder' => date('Y-m-d H:i:s')],
//                    'pluginOptions' => [
//                        'autoclose' => true,
//                        'format' => 'yyyy-mm-dd hh:ii:ss'
//                    ]
//                ]);
//                ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-md-6 col-lg-6">-->
<!--            <div class="form-group">-->
<!--                --><?php //echo $form->field($model, 'attachment')->fileInput(['maxlength' => true]) ?>
<!--        </div>-->
<!--    </div>-->

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?php echo $form->field($model, 'message')->widget(Redactor::className(), [
                    'settings' => [
                        'minHeight' => 200,
                        'plugins' => [
                            'clips',
                            'fullscreen'
                        ],
                        'imageUpload' => Url::to(['/post/image-upload'])
                    ]
                ]);
                ?>
<!--                --><?php //echo $form->field($model, 'message')->textarea(['maxlength' => true, 'rows' => 6]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>