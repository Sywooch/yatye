<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/10/2016
 * Time: 20:31
 */
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use unclead\widgets\TabularInput;
use kartik\widgets\Select2;

$this->title = 'Gallery - ' . $place->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if (!empty($galleries)) : ?>
        <div class="row">
            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'method' => 'get']) ?>
            <?= $form->field($model, 'name')
                ->dropDownList($places, ['id' => 'place-id', 'prompt' => 'Select Place'])
                ->label(false); ?>
            <small>: <?php echo count($count) ?></small>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['gallery/gallery', 'place_id' => $place_id]),
                ]); ?>
                <?= TabularInput::widget([
                    'models' => $galleries,
                    'attributeOptions' => [
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnChange' => false,
                        'validateOnSubmit' => true,
                        'validateOnBlur' => false,
                    ],
                    'addButtonOptions' => [
                        'class' => 'btn btn-secondary',
                        'style' => 'margin-top:30px',
                    ],
                    'columns' => [
                        [
                            'name' => 'name',
                            'title' => 'Image',
                            'type' => 'static',
                            'value' => function ($data) {
                                return Html::img($data->getPath(), [
                                    'class' => 'img-responsive',
                                    'style' => 'width: 100px;height:70px;',
                                ]);
                            },
                        ],
                        [
                            'name' => 'service_id',
                            'title' => 'Service',
                            'type' => Select2::className(),
                            'options' => [
                                'data' => $services,
                                'options' => [
                                    'placeholder' => Yii::t('app', 'Service'),
                                ],
                                'pluginOptions' => [

                                ],
                            ],
                        ],
//                    [
//                        'name' => 'expire_at',
//                        'title' => 'Expire',
//                        'type' => DatePicker::classname(),
//                        'options' => [
//                            'options' => [
//                                'placeholder' => Yii::t('app', 'Expire'),
//                                'value' => date('Y-d-m'),
//                            ],
//                            'pluginOptions' => [
//                                'autoclose' => true,
//                                'format' => 'yyyy-mm-dd'
//                            ],
//                        ],
//                    ],
                    ],
                ]) ?>
                <?php echo Html::submitButton('Save Galleries', ['class' => 'btn btn-primary pull-right']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Oops!</strong> There is no gallery!
        </div>
    <?php endif; ?>

</div>
<?php
$this->registerJs(
    '$(document).ready(function(){
        $("#place-id").change(function(){
            var e = document.getElementById("place-id");
            var strSel =  e.options[e.selectedIndex].value;
            window.location.href="' . Yii::$app->urlManager->createUrl('/gallery/gallery?place_id=') . '" + strSel;
        });
    });', View::POS_READY);
?>