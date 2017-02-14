<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WorkingHours */

$this->title = 'Add Working Hours';
//$this->params['breadcrumbs'][] = ['label' => 'Working Hours', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
