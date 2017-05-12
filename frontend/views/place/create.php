<?php


/* @var $this yii\web\View */
/* @var $model backend\models\place\Place */

$this->title = Yii::t('app', 'New Place');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Places'), 'url' => ['/place/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
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
