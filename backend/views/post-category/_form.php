<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\post\PostCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-white p20 mb50">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'post_type_id')->dropDownList($post_types, [
        'id' => 'district_id',
        'prompt' => Yii::t('app', 'Select a post type ...'),
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
