<?php
/* @var $this yii\web\View */
/* @var $model backend\models\post\Post */
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $model->getPostTypeName(), 'url' => $model->getPostTypeUrl()];
$this->params['breadcrumbs'][] = ['label' => $model->getPostCategoryName(), 'url' => $model->getPostCategoryUrl()];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('@app/views/post-details/_details', [
    'model' => $model,
    'post_category' => $post_category,
]) ?>

<div class="col-sm-4 col-lg-3 p30 visible-md visible-lg">
    <?php if ($model->status != Yii::$app->params['active']) : ?>
        <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-upload']), ['publish', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
    <?php endif; ?>
    <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
    <?php echo Html::a(Html::tag('span', '', ['class' => 'fa fa-remove']), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ])
    ?>
</div>
