<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoice */

$this->title = 'Invoice ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p20 mb50">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ($model->status == Yii::$app->params['not_paid']) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'client_id',
                'label' => Yii::t('app', 'Client'),
                'value' => function ($model) {
                    return $model->getClient()->name;
                },
            ],
            [
                'attribute' => 'contract_id',
                'label' => Yii::t('app', 'Client'),
                'value' => function ($model) {
                    return $model->getContract()->title;
                },
            ],
            'discount',
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
