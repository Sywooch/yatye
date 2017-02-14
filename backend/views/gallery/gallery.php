<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/10/2016
 * Time: 20:31
 */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use unclead\widgets\TabularInput;
use unclead\widgets\MultipleInputColumn;
use yii\grid\GridView;
use kartik\widgets\DepDrop;
$this->title = 'Gallery';
?>
<div class="background-white p20 mb50">
    <div class="row">
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'method' => 'get']) ?>
        <div class="form-group">
            <?= $form->field($model, 'name')->dropDownList($places, ['id' => 'place-id', 'prompt' => 'Select Place'])->label(false); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['gallery/gallery', 'place_id' => $place_id]),
            ]);
//            $services_data = $this->context->accessDataByIds($model->category_id);
//            $services = $services_data['get_services'];
//
//            $service_data_in_array = $this->context->accessDataByIds($services);
//            $services_in_array = $service_data_in_array['get_data_in_array'];

            ?>
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
                ],
                'columns' => [
                    [
                        'name' => 'name',
                        'title' => 'Image',
                        'type' => 'static',
                        'value' => function ($data) {
                            return Html::img(Yii::$app->params['galleries'] . $data->name, [
                                'class' => 'img-responsive',
                                'style' => 'width: 80px;height:40px;',
                            ]);
                        },
                    ],
                    [
                        'name' => 'service_id',
                        'title' => 'Service',
                        'type' => 'dropDownList',
                        'items' => $services,
                    ],

//                    [
//                        'name' => 'category_id',
//                        'title' => 'Category',
//                        'type' => 'dropDownList',
//                        'items' => $categories,
//                        'options' => [
//                            'id' => 'category_id',
//                        ],
//                    ],
//                    [
//                        'name' => 'service_id',
//                        'title' => 'Service',
//                        'type' => DepDrop::className(),
//                        'options' => [
//                            'pluginOptions' => [
//                                'depends' => ['category_id'],
//                                'placeholder' => Yii::t('app', 'Select a service ...'),
//                                'url' => Url::to(['/gallery/services']),
//                            ],
//                            'id' => 'service_id',
//                            'data' => $services_in_array,
//                        ],
//                        'headerOptions' => [
//                            'style' => 'width: 250px;',
//                        ]
//                    ],
                    [
                        'name' => 'caption',
                        'title' => 'Caption',
                        'type' => MultipleInputColumn::TYPE_TEXT_INPUT,
                    ],

                ],
            ]) ?>
            <?php echo Html::submitButton('Save Galleries', ['class' => 'btn btn-primary pull-right']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
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