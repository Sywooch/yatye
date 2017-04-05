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

<?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'filter div']]); ?>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <?= $form->field($model, 'key_word')
                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Keyword')])
                ->label(false)
                ->hint(Yii::t('app', 'This will help you out if you know the name.'), ['class' => 'hint']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <?php echo $form->field($model, 'province_id')->dropDownList($provinces, [
                'id' => 'province_id',
                'prompt' => Yii::t('app', 'Province'),
            ])->label(false); ?>
        </div>

        <div class="col-sm-12 col-md-3">
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
        </div>

        <div class="col-sm-12 col-md-3">
            <?php echo $form->field($model, 'category_id')->dropDownList($categories, [
                'id' => 'category_id',
                'prompt' => Yii::t('app', 'Category'),
            ])->label(false); ?>
        </div>
        <div class="col-sm-12 col-md-3">
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