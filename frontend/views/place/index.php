<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Places';
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/place']) ?>"><?= Html::encode($this->title) ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData();
        echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="background-white p20 mb30">
                <h3 class="page-title">
                    List of my places
                    <?= Html::a('Add', ['create'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
                </h3>
                <div class="row">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'name',
//                                'neighborhood',
//                                'street',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url . '/' . $model->slug, ['class' => 'btn btn-primary btn-xs']);
                                        },
                                        'update' => function ($url, $model) {
                                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url, ['class' => 'btn btn-secondary btn-xs']);
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
                            'tableOptions' => ['class' => 'table mb0'],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
