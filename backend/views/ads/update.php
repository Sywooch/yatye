<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ads */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ads',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="col-sm-12">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'sizes' => $sizes,
    ]) ?>
</div>
