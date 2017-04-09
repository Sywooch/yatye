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

            <div class="panel">
                <div class="panel-heading">
                    <?= Html::a(Yii::t('app', 'Facebook Events'), ['/facebook'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                </div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'label' => 'Name',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(substr($model->name, 0, 50), ['update', 'id' => $model->id], ['target' => '_blank']);
                                },
                            ],

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
                                ],
                            ],
                        ],
                        'tableOptions' => ['class' => 'table mb0'],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>


</div>
