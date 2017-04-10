<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FacebookEvents */

$this->title = Yii::t('app', 'Create Facebook Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Facebook Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facebook-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
