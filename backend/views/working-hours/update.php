<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WorkingHours */

$this->title = 'Update: ' . ' ' . $model->day;
$this->params['breadcrumbs'][] = ['label' => 'Working Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="page-title">
        <h4><?= Html::encode($this->title) ?></h4>
    </div><!-- /.page-title -->
    <div class="col-sm-12">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
