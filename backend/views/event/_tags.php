<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 17:25
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\grid\GridView;

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['event/add-tags', 'event_id' => $model->id]),
        ]); ?>

        <div class="form-group">
            <?php echo $form->field($event_has_tags, 'event_tag_id')->widget(Select2::classname(), [
                'data' => $tags,
                'options' => [
                    'placeholder' => 'Select tags',

                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ])->label(false); ?>

        </div>

        <div class="form-group">
            <?= Html::submitButton('Add Tag', ['class' => 'btn btn-primary pull-right']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<br>
<br>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="table-responsive">
            <?php echo GridView::widget([
                'dataProvider' => $tagDataProvider,
                'layout' => '{items}{pager}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('app', 'Tag'),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a(Html::tag('i', '',
                                    ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/event/delete-item/?event_tag_id=' . $model['id'] . '&event_id=' . $model['event_id'],
                                    [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                            'method' => 'post',
                                        ],
                                    ]
                                );
                            },
                        ],
                    ],
                ],
                'tableOptions' => ['class' => 'table mb0'],
            ]); ?>
        </div>
    </div>
</div>