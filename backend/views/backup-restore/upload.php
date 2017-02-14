<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\widgets\FileInput;
use kartik\file\FileInput;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


<?= $form->field($model, 'upload_file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'mysql/*.sql'],
    'pluginLoading'=>false,
    'pluginOptions'=>[
        'showPreview' => false,
        'allowedFileExtensions'=>['sql'],
    ],
]); ?>


<div class="form-group">
    <?=
    Html::submitButton( 'Saxla' ,
        ['class' => 'btn btn-success']
    ) ?>
</div>

<?php ActiveForm::end(); ?>

<!-- form -->
