<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 17:26
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(); ?>
<div class="background-white p30 mb50">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 5]) ?>
            </div>
        </div>
        <div class="col-md-5 col-lg-5">

            <div class="form-group">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'start_at')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'end_at')->textInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'banner')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?php echo $form->field($model, 'profile_type')->dropDownList($profile_types, [
                    'prompt' => Yii::t('app', 'Select a profile type'),
                ])->label(false);
                ?>
            </div>
            <div class="form-group">
                <?php echo $form->field($model, 'status')->dropDownList($status, [
                    'prompt' => Yii::t('app', 'Select a status'),
                ])->label(false);
                ?>
            </div>
        </div>
        <div class="col-md-7 col-lg-7">
            <input id="pac-input" class="controls form-control mb30" type="text" placeholder="Enter a location">

            <div id="map-canvas"></div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <?= $form->field($model, 'latitude')->textInput(['id' => 'input-latitude']) ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <?= $form->field($model, 'longitude')->textInput(['id' => 'input-longitude']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 40px;">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
