<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Invoice */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Invoice',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invoices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Invoice ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php if ($model->status == Yii::$app->params['not_paid'] && ($model->type == Yii::$app->params['normal_sell'] || $model->type == Yii::$app->params['credit'])) : ?>
                <p>
                    <?= Html::a(Yii::t('app', 'Paid'), ['paid', 'id' => $model->id], [
                        'class' => 'btn btn-primary pull-right',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to change the status of this item?'),
                        ],
                    ]) ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="row">
            <?= $this->render('_form', [
                'model' => $model,
                'status' => $status,
                'clients' => $clients,
                'invoice_items' => $invoice_items,
                'types' => $types,
                'contracts' => $contracts,
            ]) ?>
        </div>

    </div>
</div>