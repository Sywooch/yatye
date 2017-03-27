<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30 row">

    <div class="col-sm-12">

        <div class="row">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Name',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->name, ['update', 'id' => $model->id], ['target' => '_blank']);
                        },
                    ],
//            'address',
//                    'start_date',
//                    'start_time',
//                    'end_date',
//                    'end_time',
                    // 'banner',
                    // 'profile_type',
                    // 'latitude',
                    // 'longitude',
                    // 'created_at',
                    // 'updated_at',
                    // 'status',
                    // 'created_by',
                    // 'updated_by',
                    // 'slug',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {status}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                            },
                            'update' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url,
                                    ['class' => 'btn btn-secondary btn-xs']);
                            },
                            'status' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/event/status/?id=' . $model['id'], [
                                    'class' => 'btn btn-primary btn-xs',
                                ]);
                            },
//                    'delete' => function ($url, $model) {
//                        return Html::a(Html::tag('i', '', ['class' => 'fa fa-trash']), $url, [
//                            'class' => 'btn btn-danger btn-xs',
//                            'data' => [
//                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                                'method' => 'post',
//                            ],
//                        ]);
//                    },
                        ],
                    ],
                ],
                'tableOptions' => ['class' => 'table mb0'],
            ]); ?>
        </div>
    </div>


</div>
