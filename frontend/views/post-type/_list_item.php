<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */
/* @var $model backend\models\post\Post */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="post text-left item background-white p30 div" data-key="<?= $model->id ?>">
    <?php if ($model->image != '' || $model->image != null): ?>
        <div class="post-image">
            <img src="<?php echo $model->getPostPicture(); ?>"
                 alt="<?php echo $model->title; ?>"
                 class="img-alt img-responsive"
                 style="width: 180px; 120px;">
            <a class="read-more" href="<?php echo $model->getPostUrl(); ?>">View</a>
        </div>
    <?php endif; ?>
    <div class="post-content">
        <h2>
            <a href="<?php echo $model->getPostUrl() ?>"><?php echo $model->title; ?><a>
        </h2>
        <p><?= nl2br($model->introduction) ?></p>
    </div>

    <div class="post-meta clearfix">
        <div class="post-meta-date">
            <i class="fa fa-clock-o"></i>
            <?php echo $model->getLastUpdatedDate(); ?>
        </div>
        <div class="post-meta-categories">
            <i class="fa fa-tags"></i>
            <a href="<?php echo $model->getPostCategoryUrl(); ?>"><?php echo $model->getPostCategoryName(); ?></a>
        </div>
        <div class="post-meta-more">
            <a href="<?php echo $model->getPostUrl(); ?>" target="_blank">Read More <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

