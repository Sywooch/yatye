<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Enquiries');
?>

<div class="background-white p30">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'place_id',
                [
//                    'attribute' => 'place_id',
                    'label' => Yii::t('app', 'Place'),
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model->getPlaceName(), ['/settings', 'id' => $model->id], ['target' => '_blank']);
                    },
                ],
                'name',
//            'email:email',
                'subject',
                // 'message:ntext',
                'created_at',
                // 'updated_at',
                // 'status',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => 'fa fa-eye']), $url, ['class' => 'btn btn-primary btn-xs']);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
