<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AboutUs */

$this->title = Yii::t('app', 'Add About Us');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About us'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

