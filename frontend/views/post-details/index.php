<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
?>
<div class="mt50 p30">
    <?php echo $this->render('_details') ?>
    <?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>
</div>
