<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GooglePlaces */

$this->title = Yii::t('app', 'Create Google Places');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Google Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-places-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
