<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="background-white p30 mb30">
    <?php $form = ActiveForm::begin(); ?>
    <?php if(!$model->isNewRecord) :  ?>
        <div class="row">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-xl pull-right']) ?>
        </div>
    <?php endif;  ?>

    <div class="row">
        <div class="form-group">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
<!--        <div class="form-group">-->
<!--            --><?////= $form->field($model, 'introduction')->textarea(['rows' => 3]) ?>
<!--        </div>-->
        <div class="form-group">
            <?php echo $form->field($model, 'content')->widget(Redactor::className(), [
                'settings' => [
                    'minHeight' => 600,
                    'plugins' => [
                        'clips',
                        'fullscreen',
                    ],
                    'imageUpload' => Url::to(['/my-blog/image-upload'])
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row center">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary btn-xl' : 'btn btn-primary btn-xl']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

