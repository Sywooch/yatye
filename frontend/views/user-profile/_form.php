<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="background-white p20 mb30">
    <h3 class="page-title">
        Contact Information
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => 'btn btn-primary btn-xs pull-right']) ?>
    </h3>

    <div class="row">
        <div class="form-group col-sm-6">
            <label>First Name</label>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="form-group col-sm-6">
            <label>Last Name</label>
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false) ?>
        </div>

        <div class="form-group col-sm-6">
            <label>E-mail</label>
            <?= $form->field($model, 'email')->textInput(['value'=>Yii::$app->user->identity->email])->label(false) ?>
        </div>

        <div class="form-group col-sm-6">
            <label>Phone</label>
            <?= $form->field($model, 'phone')->textInput()->label(false) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php if(!$model->isNewRecord) : ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Social Connections

            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-xs pull-right']) ?>
        </h3>

        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Facebook</label>

                <div class="col-sm-9">
                    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Twitter</label>

                <div class="col-sm-9">
                    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Linkedin</label>

                <div class="col-sm-9">
                    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Google plus</label>

                <div class="col-sm-9">
                    <?= $form->field($model, 'google_plus')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Instagram</label>

                <div class="col-sm-9">

                    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php $form = ActiveForm::begin(); ?>

    <div class="background-white p20 mb30">
        <h3 class="page-title">
            Biography

            <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-xs pull-right']) ?>
        </h3>

        <?= $form->field($model, 'bio')->textarea(['rows' => 6])->label(false) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php endif ?>