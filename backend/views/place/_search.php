<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchPlace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="place-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get',]); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?php  echo $form->field($model, 'name')->textInput(['placeholder' => Yii::t('app', 'Name')])->label(false); ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?php  echo $form->field($model, 'street')->textInput(['placeholder' => Yii::t('app', 'Street')])->label(false); ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?php  echo $form->field($model, 'neighborhood')->textInput(['placeholder' => Yii::t('app', 'Neighborhood')])->label(false); ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <?php echo $form->field($model, 'province_id')->dropDownList($provinces, [
                'id' => 'province_id',
                'prompt' => Yii::t('app', 'Province'),
            ])->label(false); ?>
        </div>
        <div class="col-md-4 col-lg-3">
            <?php echo $form->field($model, 'district_id')->widget(DepDrop::className(), [
                'options' => [
                    'id' => 'district_id',
                ],
                'data' => $this->context->accessDistricts($model),
                'pluginOptions' => [
                    'depends' => ['province_id'],
                    'placeholder' => Yii::t('app', 'District'),
                    'url' => Url::to(['/place/districts'])
                ]
            ])->label(false); ?>
        </div>
        <div class="col-md-4 col-lg-3">
            <?php echo $form->field($model, 'sector_id')->widget(DepDrop::className(), [
                'options' => ['id' => 'sector_id'],
                'data' => $this->context->accessSectors($model),
                'pluginOptions' => [
                    'depends' => ['district_id'],
                    'placeholder' => Yii::t('app', 'Sector'),
                    'url' => Url::to(['/place/sectors'])
                ]
            ])->label(false); ?>
        </div>
        <div class="col-md-4 col-lg-3">
            <?php echo $form->field($model, 'cell_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'cell_id'],
                'data' => $this->context->accessCells($model),
                'pluginOptions' => [
                    'depends' => ['sector_id'],
                    'placeholder' => 'Cell',
                    'url' => Url::to(['/place/cells'])
                ]
            ])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'profile_type')->dropDownList($profile_types, [
                'prompt' => Yii::t('app', 'Profile type'),
            ])->label(false); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'status')->dropDownList($status, [
                'prompt' => Yii::t('app', 'Status'),
            ])->label(false); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'category_id')->dropDownList($categories, [
                'id' => 'category_id',
                'prompt' => Yii::t('app', 'Category'),
            ])->label(false); ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php echo $form->field($model, 'service_id')->widget(DepDrop::className(), [
                'options' => [
                    'id' => 'service_id',
                ],
                'data' => $this->context->accessServices($model),
                'pluginOptions' => [
                    'depends' => ['category_id'],
                    'placeholder' => Yii::t('app', 'Service'),
                    'url' => Url::to(['/place/services'])
                ]
            ])->label(false); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['/place'], ['class' => 'btn btn-default pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
