<?php
/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Update: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['/event/']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] ='Update';
?>
<div class="container">
    <div class="row">
        <?php $data = $this->context->accessData(); echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
