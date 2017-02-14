<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 31/07/2016
 * Time: 11:37
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\form\ActiveForm;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\select2\Select2;

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['settings/other-places', 'place_id' => $model->id]),
                ]); ?>

                <div class="form-group">

                    <?php echo $form->field($place_has_another, 'other_place_id')->widget(Select2::classname(), [
                        'data' => $available_other_places,
                        'options' => [
                            'placeholder' => 'Select other places',

                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true,
                        ],
                    ])->label(false); ?>

                </div>

                <div class="form-group">
                    <?= Html::submitButton('Add Other Places', ['class' => 'btn btn-primary pull-right']) ?>
                </div>
                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>
</div>
