<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NewsLetter */

$this->title = Yii::t('app', 'Create News Letter');
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
            'types' => $types,
        ]) ?>
    </div>
</div>
