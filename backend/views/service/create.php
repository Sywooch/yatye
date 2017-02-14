<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title = 'Create Service';
//$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->render('_form', [
            'model' => $model,
            'categories' => $categories,
            'types' => $types,
        ]) ?>
    </div>
</div>


