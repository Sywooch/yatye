<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Post Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Post Category'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
        </p>
        <div class="panel panel">
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'post_type_id',
                            'label' => Yii::t('app', 'Post type'),
                            'value' => function ($model) {
                                return $model->getPostTypeName();
                            },
                        ],
                        'name',
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
                                    return Html::a(Html::tag('i', '', ['class' => ($model->status == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/post-category/status/?id=' . $model->id, [
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
