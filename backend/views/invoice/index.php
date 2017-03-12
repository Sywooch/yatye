<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Invoices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p20 mb50">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Invoice'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'client_id',
                'label' => Yii::t('app', 'Client'),
                'value' => function ($model) {
                    return $model->getClient()->name;
                },
            ],
            'discount',
            'status',
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{send} {view} {update} {paid}',
                'buttons' => [

                    'view' => function ($url, $model) {
                        return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                    },
                    'update' => function ($url, $model) {
                        if ($model->status == Yii::$app->params['not_paid'] || $model->type == Yii::$app->params['proforma']) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url,
                                ['class' => 'btn btn-secondary btn-xs']);
                        }
                    },
                    'paid' => function ($url, $model) {
                        if ($model->status == Yii::$app->params['not_paid'] && $model->type != Yii::$app->params['proforma']) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-battery-quarter']), $url, [
                                'class' => 'btn btn-primary btn-xs',
                                'title' => 'Paid',
                                'data' => [
                                    'confirm' => Yii::t('app', '\'Are you sure you want to change the status of this item?'),
                                ],
                            ]);
                        }
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table mb0'],
    ]); ?>
</div>
