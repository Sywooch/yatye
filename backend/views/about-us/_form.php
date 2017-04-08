<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutUs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

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


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
