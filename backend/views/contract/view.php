<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Contract */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p20 mb50">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'client_id',
                'label' => Yii::t('app', 'Client'),
                'value' => function ($model) {
                    return $model->getClient();
                },
            ],
            'title',
            'summary:ntext',
            'path',
            'start_at',
            'end_at',
            [
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'value' => function ($model) {
                    return $model->getStatus();
                },
            ],
            [
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'value' => function ($model) {
                    return $model->getStatus();
                },
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'created_by',
                'label' => Yii::t('app', 'Created By'),
                'value' => function ($model) {
                    return $model->getUser();
                },
            ],
            [
                'attribute' => 'updated_by',
                'label' => Yii::t('app', 'Updated By'),
                'value' => function ($model) {
                    return $model->getUser();
                },
            ],
        ],
    ]) ?>

</div>
