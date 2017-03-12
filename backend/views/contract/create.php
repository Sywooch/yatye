<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Contract */

$this->title = Yii::t('app', 'Create Contract');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
            'clients' => $clients,
            'status' => $status,
        ]) ?>
    </div>
