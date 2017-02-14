<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Event',
]) . $model->name;
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/event']) ?>"><?php echo Yii::t('app', 'Events'); ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['view', 'id' => $model->id]) ?>"><?php echo $model->name; ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
