<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="background-white p20 mb50">
    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    <div class="row">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'place_id',
                    'label' => Yii::t('app', 'Place'),
                    'value' => function ($model) {
                        return $model->getPlaceName();
                    },
                ],
                [
                    'attribute' => 'service_id',
                    'label' => Yii::t('app', 'Service'),
                    'value' => function ($model) {
                        return $model->getServiceName();
                    },
                ],
//                'title',
                'caption',
//                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-edit']), $url, ['class' => 'btn btn-secondary btn-xs']);
                        },
                    ],


                ],
            ],
        ]); ?>
    </div>
</div>