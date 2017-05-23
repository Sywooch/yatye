<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-view">

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
            'title',
            'image',
            'start_at',
            'end_at',
            'type',
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'label' => Yii::t('app', 'Status'),
                'value' => function ($model) {
                    return $model->getStatus();
                },
            ],
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
            'url:url',
        ],
    ]) ?>

</div>
