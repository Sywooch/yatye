<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GooglePlaces */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Google Places',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Google Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="google-places-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
