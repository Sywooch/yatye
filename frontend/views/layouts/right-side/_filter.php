<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/3/17
 * Time: 1:13 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use frontend\models\Filter;
use yii\helpers\ArrayHelper;
use common\models\Province;
use backend\models\place\Category;
?>

<div class="widget">
    <h2 class="widgettitle">Filter</h2>

    <?php $model = new Filter();
    $provinces = ArrayHelper::map(Province::find()->all(), 'id', 'name');
    $categories = ArrayHelper::map(Category::find()->where(['status' => Yii::$app->params['active']])
        ->all(), 'id', 'name'); ?>
    <div class="background-white p20 div">
        <?php $form = ActiveForm::begin(['action' => ['/filter'], 'method' => 'get']); ?>
        <?= $form->field($model, 'key_word')
            ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Type a name of the place')])
            ->label(false); ?>
        <?php echo $form->field($model, 'province_id')->dropDownList($provinces, [
            'id' => 'province_id',
            'prompt' => Yii::t('app', 'Province'),
        ])->label(false); ?>
        <?php echo $form->field($model, 'district_id')->widget(DepDrop::className(), [
            'options' => [
                'id' => 'district_id',
            ],
            'data' => $this->context->accessDistricts($model),
            'pluginOptions' => [
                'depends' => ['province_id'],
                'placeholder' => Yii::t('app', 'District'),
                'url' => Url::to(['/filter/districts'])
            ]
        ])->label(false); ?>
        <?php echo $form->field($model, 'category_id')->dropDownList($categories, [
            'id' => 'category_id',
            'prompt' => Yii::t('app', 'Category'),
        ])->label(false); ?>
        <?php echo $form->field($model, 'service_id')->widget(DepDrop::className(), [
            'options' => [
                'id' => 'service_id',
            ],
            'data' => $this->context->accessServices($model),
            'pluginOptions' => [
                'depends' => ['category_id'],
                'placeholder' => Yii::t('app', 'Service'),
                'url' => Url::to(['/filter/services'])
            ]
        ])->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Filter'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
