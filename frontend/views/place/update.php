<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Place */

$this->title = 'Update: ' . ' ' . $model->name;
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li><a href="<?php echo Url::to(['/place']) ?>"><?php echo Yii::t('app', 'Places'); ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['view', 'id' => $model->id]) ?>"><?php echo $model->name; ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <?= $this->render('_form', [
                'model' => $model,
                'districts' => $districts,
            ]) ?>

        </div>
    </div>
</div>
