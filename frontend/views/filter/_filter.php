<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 4:36 PM
 */
/* @var $this yii\web\View */
/* @var $model frontend\models\Filter */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

?>
<?php

$district_data = $this->context->accessDataByIds($model->district_id);
$districts = $district_data['get_districts'];
$district_data_in_array = $this->context->accessDataByIds($districts);
$district_in_array = $district_data_in_array['get_data_in_array'];

$service_data = $this->context->accessDataByIds($model->service_id);
$services = $service_data['get_services'];
$service_data_in_array = $this->context->accessDataByIds($services);
$service_in_array = $service_data_in_array['get_data_in_array'];


$form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => ['class' => 'filter div']
]); ?>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'key_word')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Type a name of the place')])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <?php echo $form->field($model, 'province_id')->dropDownList($provinces, [
                'id' => 'province_id',
                'prompt' => Yii::t('app', 'Select province'),
            ])->label(false); ?>
        </div>

        <div class="col-sm-12 col-md-3">
            <?php echo $form->field($model, 'district_id')->widget(DepDrop::className(), [
                'options' => [
                    'id' => 'district_id',
                ],
                'data' => $district_in_array,
                'pluginOptions' => [
                    'depends' => ['province_id'],
                    'placeholder' => Yii::t('app', 'Select district'),
                    'url' => Url::to(['/filter/districts'])
                ]
            ])->label(false); ?>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="form-group">
                <?php echo $form->field($model, 'category_id')->dropDownList($categories, [
                    'id' => 'category_id',
                    'prompt' => Yii::t('app', 'Select category'),
                ])->label(false); ?>
            </div>
        </div>
        <div class="col-sm-12 col-md-3">
            <?php echo $form->field($model, 'service_id')->widget(DepDrop::className(), [
                'options' => [
                    'id' => 'service_id',
                ],
                'data' => $service_in_array,
                'pluginOptions' => [
                    'depends' => ['category_id'],
                    'placeholder' => Yii::t('app', 'Select service'),
                    'url' => Url::to(['/filter/services'])
                ]
            ])->label(false); ?>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-8">
            <div class="filter-actions">
                <a href="<?php echo Url::to(['/filter']) ?>"><i
                            class="fa fa-close"></i> <?php echo Yii::t('app', 'Reset Filter') ?></a>
            </div>
        </div>

        <div class="col-sm-4">
            <?= Html::submitButton(Yii::t('app', 'Filter'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>