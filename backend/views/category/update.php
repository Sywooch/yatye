<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title =  $model->name;

?>
<div class="background-white p20">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-sm-12">
            <?= $this->render('_form', [
                'model' => $model,
                'status' => $status,
            ]) ?>
        </div>
    </div>
</div>

