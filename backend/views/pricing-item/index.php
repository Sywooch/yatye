<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pricing Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p20">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pricing Item'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'created_at',
            'updated_at',
             'status',

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
            ]
        ],
    ]); ?>
</div>
