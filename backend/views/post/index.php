<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="page-title">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel">
            <div class="panel-body">
                <?= $this->render('_search', [
                    'model' => $searchModel,
                    'status' => $status,
                    'post_types' => $post_types,

                ]) ?>
            </div>
        </div>

        <div class="panel panel">
            <div class="panel-body">
                <div class="row">
                    <p>
                        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
                    </p>
                </div>
                <div class="row">
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'label' => 'Title',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(substr($model->title, 0, 50), ['/post/view', 'id' => $model->id], ['target' => '_blank']);
                                },
                                'contentOptions' => ['style' => ['max-width' => '400px']],

                            ],
                            [
                                'attribute' => 'post_type_id',
                                'label' => Yii::t('app', 'Post type'),
                                'value' => function ($model) {
                                    return $model->getPostTypeName();
                                },
                            ],
                            [
                                'attribute' => 'post_category_id',
                                'label' => Yii::t('app', 'Post category'),
                                'value' => function ($model) {
                                    return $model->getPostCategoryName();
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
                                        return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url, ['class' => 'btn btn-secondary btn-xs']);
                                    },
                                    'status' => function ($url, $model) {
                                        return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), $url, [
                                            'class' => 'btn btn-danger btn-xs',
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


