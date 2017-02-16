<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'List of places';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<!--    <pre>--><?php //echo  print_r($actions); ?><!--</pre>-->
    <div class="col-sm-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="background-white p30 mb50">
            <h4 class="page-title">
                <?= Html::encode($this->title) ?>
                <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-upload']), ['/import-places'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
            </h4>
            <div class="row">
                <?php echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'showFooter' => true,
                    'showHeader' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Name',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->name, ['/settings', 'id' => $model->id], ['target' => '_blank']);
                            },
                        ],
                        [
                            'attribute' => 'profile_type',
                            'label' => Yii::t('app', 'Profile Type'),
                            'value' => function ($model) {
                                return $model->getProfileTypeName();
                            },
                        ],
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(Html::tag('i', '', ['class' => 'fa fa-photo']), ['/gallery/gallery', 'place_id' => $model->id], ['class' => 'btn btn-default btn-xs',]);
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{up} {down} {status} {settings}',
                            'buttons' => [
                                'up' => function ($url, $model) {
                                    return ($model['profile_type'] != Yii::$app->params['PREMIUM']) ? Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-up']), Yii::$app->request->baseUrl . '/place/upgrade/?id=' . $model['id'], [
                                        'class' => 'btn btn-success btn-xs',
                                    ]) : '';
                                },
                                'down' => function ($url, $model) {
                                    return ($model['profile_type'] != Yii::$app->params['NOT_DEFINED']) ? Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-down']), Yii::$app->request->baseUrl . '/place/downgrade/?id=' . $model['id'], [
                                        'class' => 'btn btn-secondary btn-xs',
                                    ]) : '';
                                },
                                'status' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/place/status/?id=' . $model['id'], [
                                        'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                                'settings' => function ($url, $model) {
                                    return Html::a(Html::tag('i', '', ['class' => 'fa fa-cog']), Yii::$app->request->baseUrl . '/settings/?id=' . $model['id'], [
                                        'class' => 'btn btn-info btn-xs',
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
