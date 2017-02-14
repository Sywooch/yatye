<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/06/2016
 * Time: 20:59
 */
use yii\helpers\Html;
use backend\assets\RwandaguideAsset;
use yii\widgets\Pjax;
use kartik\form\ActiveForm;
use yii\web\View;
use kartik\widgets\Typeahead;
use kartik\widgets\Select2;

?>

<div class="background-white p30 mb50">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->getUrlManager()->createUrl(['settings/set-settings', 'place_id' => $model->id]),
        'type' => ActiveForm::TYPE_INLINE]); ?>
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
    <div class="form-group">
        <?= Html::submitButton('Save Settings', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
