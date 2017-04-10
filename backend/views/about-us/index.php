<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'About us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-us-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
             'created_at',
             'updated_at',

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
                        return Html::a(Html::tag('i', '', ['class' => ($model->status == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/about-us/status/?id=' . $model->id, [
                            'class' => 'btn btn-primary btn-xs',
                        ]);
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table mb0'],
    ]); ?>
</div>
