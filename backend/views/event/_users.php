<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 23:07
 */
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\grid\GridView;
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->getUrlManager()->createUrl(['event/add-users', 'event_id' => $model->id]),
    ]); ?>

    <div class="form-group">

        <?php echo $form->field($user_event, 'user_id')->widget(Select2::classname(), [
            'data' => $users,
            'options' => [
                'placeholder' => 'Select user email addresses ...',

            ],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ])->label(false); ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Add User ', ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>



<br>
<br>
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
                                    ['class' => 'fa fa-trash']), Yii::$app->request->baseUrl . '/event/delete-item/?user_id=' . $model['id'] . '&event_id=' . $model['event_id'],
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
