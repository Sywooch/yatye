<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pricings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>
    <div class="row">
        <div class="col-sm-2">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="glyphicon glyphicon-list"></i>
                </div>
                <div class="text">
                    <var></var>
                    <label class="text-muted">Pricing Items</label>
                </div>
                <div class="options">
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), ['/pricing-item'], ['class' => 'btn btn-primary btn-xs']) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="hero-widget well well-sm">
                <div class="icon">
                    <i class="glyphicon glyphicon-list"></i>
                </div>
                <div class="text">
                    <var></var>
                    <label class="text-muted">Pricing</label>
                </div>
                <div class="options">
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    'price',
                    'discount',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{add-pricing-item} {view} {update} {delete} {publish}',
                        'buttons' => [
                            'add-pricing-item' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']), $url, ['class' => 'btn btn-secondary btn-xs']);
                            },
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
                            'publish' => function ($url, $model) {
                                return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['publish']) ? 'fa fa-unlock' : 'fa fa-lock']), $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to publish this pricing?'),
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
</div>
