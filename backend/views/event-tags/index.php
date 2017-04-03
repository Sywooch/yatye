<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Event Tags');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="background-white p20 mb50">
    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    <p>
        <?= Html::a(Yii::t('app', 'Create Event Tags'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
//                'descriptions:ntext',
                'status',
                'created_at',
                // 'updated_at',
                // 'created_by',
                // 'updated_by',
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
                            return Html::a(Html::tag('i', '', ['class' => ($model->status == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/event-tags/status/?id=' . $model->id, [
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