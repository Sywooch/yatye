<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Subscription */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Subscription',
    ]) . $model->email;
?>
<div class="background-white p20">
    <div class="row">
        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'places' => $places,
            ]) ?>
        </div>
    </div>
</div>
