<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\post\SearchPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'title')->textInput(['placeholder' => Yii::t('app', 'Title')])->label(false); ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'status')->dropDownList($status, [
                'prompt' => Yii::t('app', 'Status'),
            ])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'post_type_id')->dropDownList($post_types, [
                'id' => 'post_type_id',
                'prompt' => Yii::t('app', 'Post types'),
            ])->label(false); ?>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php echo $form->field($model, 'post_category_id')->widget(DepDrop::className(), [
                'options' => [
                    'id' => 'post_category_id',
                ],
                'data' => $this->context->accessPostCategories($model),
                'pluginOptions' => [
                    'depends' => ['post_type_id'],
                    'placeholder' => Yii::t('app', 'Post categories'),
                    'url' => Url::to(['/post/post-categories'])
                ]
            ])->label(false); ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary pull-right']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['/post'], ['class' => 'btn btn-default pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
