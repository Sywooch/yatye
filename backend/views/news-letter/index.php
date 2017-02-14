<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News Letters');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-white p20 mb50">
    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    <p>
        <?= Html::a(Yii::t('app', 'Create News Letter'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'subject',
//                'message:ntext',
                'type',
//                'send_at',
//                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{send} {view} {update} {delete}',
                    'buttons' => [
                        'send' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['draft']) ? 'fa fa-send' : '']), Yii::$app->request->baseUrl . '/news-letter/send/?id=' . $model->id,
                                ['class' => ($model['status'] == Yii::$app->params['draft']) ? 'btn btn-primary btn-xs' : '']);
                        },
                        'view' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['draft']) ? 'fa fa-edit' : '']), $url,
                                ['class' => ($model['status'] == Yii::$app->params['draft']) ? 'btn btn-secondary btn-xs' : '']);
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
