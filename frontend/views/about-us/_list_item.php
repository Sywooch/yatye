<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */
/* @var $model backend\models\AboutUs */
?>
<div class="post text-left item background-white p30 div" data-key="<?= $model->id ?>">
    <?php if ($model->image != '' || $model->image != null): ?>
        <div class="post-image">
            <img src="<?php echo $model->getPostThumbnails(); ?>"
                 alt="<?php echo $model->title; ?>"
                 class="img-alt img-responsive">
            <a class="read-more" href="<?php echo $model->getPostUrl(); ?>"><?php echo Yii::t('app', 'View') ?></a>
        </div>
    <?php endif; ?>
    <div class="post-content">
        <h2>
            <a href="<?php echo $model->getPostUrl() ?>"><?php echo $model->title; ?><a>
        </h2>
        <p><?= nl2br($model->content) ?></p>
    </div>

    <div class="post-meta clearfix">
        <div class="post-meta-date">
            <i class="fa fa-clock-o"></i>
            <?php echo $model->getLastUpdatedDate(); ?>
        </div>
        <div class="post-meta-more">
            <a href="<?php echo $model->getPostUrl(); ?>" target="_blank"><?php echo Yii::t('app', 'Read More') ?> <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

