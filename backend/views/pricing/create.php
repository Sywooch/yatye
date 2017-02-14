<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pricing */

$this->title = Yii::t('app', 'New Pricing');
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>