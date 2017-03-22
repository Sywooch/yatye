<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'post_type_id')->dropDownList($post_types, [
                    'id' => 'post_type_id',
                    'options' => ['id' => 'post_type_id'],
                    'prompt' => Yii::t('app', 'Select a post category ...'),
                ])->label(false); ?>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?php echo $form->field($model, 'post_category_id')->widget(DepDrop::className(), [
                    'options' => ['id' => 'post_category_id'],
                    'data' => $this->context->accessPostCategories($model),
                    'pluginOptions' => [
                        'depends' => ['post_type_id'],
                        'placeholder' => Yii::t('app', 'Select a post category ...'),
                        'url' => Url::to(['/post/post-categories'])
                    ]
                ])->label(false); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'introduction')->textarea(['maxlength' => true, 'rows' => 2]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?php echo $form->field($model, 'content')->widget(Redactor::className(), [
                    'settings' => [
                        'minHeight' => 200,
                        'plugins' => [
                            'clips',
                            'fullscreen'
                        ],
                        'imageUpload' => Url::to(['/post/image-upload'])
                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>