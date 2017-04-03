<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->getPostTypeName(), 'url' => $model->getPostTypeUrl()];
$this->params['breadcrumbs'][] = ['label' => $model->getPostCategoryName(), 'url' => $model->getPostCategoryUrl()];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mt50">
    <?php echo $this->render('_details', [
        'model' => $model,
    ]) ?>
    <?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>
</div>
