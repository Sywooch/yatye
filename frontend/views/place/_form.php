<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use vova07\imperavi\Widget as Redactor;

/* @var $this yii\web\View */
/* @var $model backend\models\place\Place */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-12">

        <div class="background-white p30 mb30">
            <h2 class="page-title"><?php echo Yii::t('app', 'Map Position'); ?></h2>
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id'=>'name']) ?>
            </div>

            <input id="pac-input" class="controls form-control mb30" type="text" placeholder="<?php echo Yii::t('app', 'Enter a location'); ?>">
            <div id="map-canvas"></div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group">
                        <label><?php echo Yii::t('app', 'Latitude'); ?></label>
                        <?= $form->field($model, 'latitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])->textInput(['id'=>'input-latitude']) ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="input-group">
                        <label><?php echo Yii::t('app', 'Longitude'); ?></label>
                        <?= $form->field($model, 'longitude', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span>{input}</div>',])->textInput(['id'=>'input-longitude']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="background-white p30 mb30">
    <h3 class="page-title">Description</h3>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'rows' => 6]) ?>
            </div>
        </div>
    </div>

</div>
<div class="background-white p30 mb30">
    <h3 class="page-title"><?php echo Yii::t('app', 'Attributes'); ?></h3>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label><?php echo Yii::t('app', 'Neighborhood'); ?></label>
                <?= $form->field($model, 'neighborhood', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-location-arrow"></i></span>{input}</div>',])->textInput(['maxlength' => true, 'id'=>'neighborhood'])->label(false) ?>
            </div>

            <div class="form-group">
                <label><?php echo Yii::t('app', 'Street'); ?></label>
                <?= $form->field($model, 'street', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-map-o"></i></span>{input}</div>',])->textInput(['maxlength' => true, 'id'=>'street']) ?>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label><?php echo Yii::t('app', 'District'); ?></label>
                <?php echo $form->field($model, 'district_id', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-compass"></i></span>{input}</div>',])->dropDownList($districts, [
                    'id' => 'district_id',
                    'prompt' => Yii::t('app', 'District'),
                ]);
                ?>
            </div>

            <div class="form-group">
                <label><?php echo Yii::t('app', 'Sector'); ?></label>
                <?php echo $form->field($model, 'sector_id', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-compass"></i></span>{input}</div>',])->widget(DepDrop::className(), [
                    'options' => ['id' => 'sector_id'],
                    'data' => $this->context->accessSectors($model),
                    'pluginOptions' => [
                        'depends' => ['district_id'],
                        'placeholder' => Yii::t('app', 'Sector'),
                        'url' => Url::to(['/place/sectors'])
                    ]
                ]);
                ?>
            </div>
            <div class="form-group">
                <label><?php echo Yii::t('app', 'Cell'); ?></label>
                <?php echo $form->field($model, 'cell_id', ['template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-compass"></i></span>{input}</div>',])->widget(DepDrop::classname(), [
                    'options' => ['id' => 'cell_id'],
                    'data' =>$this->context->accessCells($model),
                    'pluginOptions' => [
                        'depends' => ['sector_id'],
                        'placeholder' => 'Cell',
                        'url' => Url::to(['/place/cells'])
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="center">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary btn-xl' : 'btn btn-primary btn-xl']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">

    function getLocation()
    {
        var location = document.getElementById('pac-input');
        var name = document.getElementById('name');
        name.value = location.value;
    }
</script>
