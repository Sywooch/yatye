<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 18/02/2016
 * Time: 21:37
 */

/* @var $this yii\web\View */
/* @var $model common\models\Place */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use vova07\imperavi\Widget as Redactor;
?>
<?php $form = ActiveForm::begin(['action'=>Yii::$app->request->baseUrl . '/settings/set-basic-info/?id=' . $model->id]); ?>
<div class="background-white p30 mb50">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 8]) ?>
            </div>
            <div class="form-group" style="margin-top: 40px;">
                <?= Html::submitButton('Save Basic Info', ['class' => 'btn btn-primary pull-right']) ?>
            </div>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>



