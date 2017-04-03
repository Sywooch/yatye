<?php
/* @var $this yii\web\View */
/* @var $model backend\models\post\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->getPostTypeName(), 'url' => $model->getPostTypeUrl()];
$this->params['breadcrumbs'][] = ['label' => $model->getPostCategoryName(), 'url' => $model->getPostCategoryUrl()];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('@app/views/post-details/_details', [
    'model' => $model,
    'post_category' => $post_category,
]) ?>

<?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>
