<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Subscription */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Subscriptions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30">
    <div class="row">
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
                'email:email',
                'verified',
                [
                    'attribute' => 'status',
                    'label' => Yii::t('app', 'Status'),
                    'value' => function ($model) {
                        return $model->getStatus();
                    },
                ],
                'place',
                'visitor',
                'user',
                'unsubscribe_place',
                'unsubscribe_visitor',
                'unsubscribe_user',
                'created_at',
                'updated_at',
                [
                    'attribute' => 'place_id',
                    'label' => Yii::t('app', 'Place Name'),
                    'value' => function ($model) {
                        return $model->getPlaceName();
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
