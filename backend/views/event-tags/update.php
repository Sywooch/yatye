<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventTags */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Event Tags',
]) . $model->name;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
