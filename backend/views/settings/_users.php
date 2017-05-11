<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/06/2016
 * Time: 20:58
 */
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\grid\GridView;
?>
<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->getUrlManager()->createUrl(['settings/set-users', 'place_id' => $model->id]),
    ]); ?>

    <div class="form-group">

        <?php echo $form->field($user_place, 'user_id')->widget(Select2::classname(), [
            'data' => $users,
            'options' => [
                'placeholder' => 'User',

            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ])->label(false); ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="table-responsive">
            <?php echo GridView::widget([
                'dataProvider' => $userDataProvider,
                'layout' => '{items}{pager}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'email',
                        'label' => Yii::t('app', 'User'),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                return Html::a(Html::tag('i', '',
                                    ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/settings/delete-item/?user_id=' . $model['id'] . '&place_id=' . $model['place_id'],
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
