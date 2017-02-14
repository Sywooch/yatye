<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="post text-left item background-white p30 div" data-key="<?= $model->id ?>">
    <?php if ($model->image != '' || $model->image != null): ?>
        <div class="post-image">
            <img src="<?php echo Yii::$app->params['post_thumbnails'] . $model->image; ?>"
                 alt="<?php echo $model->title; ?>" style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 16px;'>
            <a class="read-more" href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $model->slug; ?>">View</a>
        </div>
    <?php endif; ?>
    <div class="post-content">
        <h2><a href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $model->slug; ?>"><?php echo $model->title; ?><a></h2>
        <p><?= nl2br($model->introduction) ?></p>
    </div>

    <div class="post-meta clearfix">
        <div class="post-meta-date"><i class="fa fa-clock-o"></i> Last update
            : <?php echo date('D d M, Y',strtotime($model->getUpdatedAt())); ?></div>
        <div class="post-meta-more">
            <a href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $model->slug; ?>">Read More <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

