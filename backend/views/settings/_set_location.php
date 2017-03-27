<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 18/02/2016
 * Time: 22:17
 */

/* @var $this yii\web\View */
/* @var $model common\models\Place */
/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
?>


<?php $form = ActiveForm::begin(['action'=>Yii::$app->request->baseUrl . '/settings/set-location/?id=' . $model->id]); ?>
<div class="background-white p30 mb50">
    <div class="row">
        <div class="col-md-5 col-lg-5">

            <div class="form-group">
                <?php echo $form->field($model, 'district_id')->dropDownList($districts, [
                    'id' => 'district_id',
                    'prompt' => Yii::t('app', 'District'),
                ]); ?>
            </div>

            <div class="form-group">
                <?php echo $form->field($model, 'sector_id')->widget(DepDrop::className(), [
                    'options' => ['id' => 'sector_id'],
                    'data' => $this->context->accessSectors($model),
                    'pluginOptions' => [
                        'depends' => ['district_id'],
                        'placeholder' => Yii::t('app', 'Sector'),
                        'url' => Url::to(['/settings/sectors'])
                    ]
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo $form->field($model, 'cell_id')->widget(DepDrop::classname(), [
                    'options' => ['id' => 'cell_id'],
                    'data' => $this->context->accessCells($model),
                    'pluginOptions' => [
                        'depends' => ['sector_id'],
                        'placeholder' => 'Cell',
                        'url' => Url::to(['/settings/cells'])
                    ]
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true, 'id'=>'neighborhood']) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'street')->textInput(['maxlength' => true, 'id'=>'street']) ?>
            </div>
        </div>
        <div class="col-md-7 col-lg-7">
            <input id="pac-input" class="controls form-control mb30" type="text" placeholder="Enter a location">

            <div id="map-canvas"></div>
            <div class="row">
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <?= $form->field($model, 'latitude')->textInput(['id'=>'input-latitude']) ?>
                    </div>
                </div>
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <?= $form->field($model, 'longitude')->textInput(['id'=>'input-longitude']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group" style="margin-top: 40px;">
            <?= Html::submitButton('Save Location', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>