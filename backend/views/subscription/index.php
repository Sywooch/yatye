<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subscriptions');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-white p30">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Subscription'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//                'id',
                'email:email',
//                'verified',
//                'status',
                'place',
                 'visitor',
                 'user',
                // 'unsubscribe_place',
                // 'unsubscribe_visitor',
                // 'unsubscribe_user',
                // 'created_at',
                // 'updated_at',
//                 'place_id',
                [
                    'attribute' => 'place_id',
                    'label' => Yii::t('app', 'Places'),
                    'value' => function ($model) {
                        return $model->getPlaceName();
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url,
                                ['class' => 'btn btn-secondary btn-xs']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-trash']), $url, [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
