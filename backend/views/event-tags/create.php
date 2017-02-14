<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EventTags */

$this->title = Yii::t('app', 'Create Event Tags');
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
