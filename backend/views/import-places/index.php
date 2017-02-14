<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Import Places';
?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['/import-places']),
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($uploadForm, 'uploadedFile')->label('Upload Places')->fileInput(['class' => 'btn btn-sm btn-default']) ?>

<?= '<br />' ?>
    <button class="btn btn-primary btn-lg">Submit</button>
<?php ActiveForm::end(); ?>