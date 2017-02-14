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

<div class="post text-left" data-key="<?= $model['id'] ?>">
    <div class="post-image">
        <?php if($model['image'] != ''): ?>
            <img src="<?php echo Yii::$app->params['blog_thumbnails'] . $model->image; ?>" alt="<?php echo $model->title;?>" style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px;'>
            <a class="read-more" href="#">View</a>
        <?php endif; ?>
    </div>

    <div class="post-content">
        <h2><a href="#"><?= $model['title'] ?><a></h2>
        <p><?= nl2br(substr($model['content'], 0, 500)) ?> ...</p>
    </div>

    <div class="post-meta clearfix">
        <div class="post-meta-author"><i class="fa fa-edit"></i> <a href="<?php echo Url::to(['update', 'id' => $model['id']]) ?>">Edit</a></div>
        <div class="post-meta-author"><i class="fa fa-caret-square-o-up"></i>
            <a href="<?php echo Url::to(['publish', 'id' => $model['id']]) ?>">
                <?php if($model['status'] == Yii::$app->params['draft'] || $model['status'] == Yii::$app->params['unpublish']) :?>
                    Publish
                <?php else: ?>
                    Unpublish
                <?php endif; ?>
            </a>
        </div>
<!--        <div class="post-meta-comments">-->
<!--            --><?php //$count = $model->getNumberOfComments(); if (!empty($count)): ?>
<!--                <i class="fa fa-comments"></i>-->
<!--                <a href="#">--><?php //echo ($count > 1) ? $count . ' comments' : $count . ' comment' ?><!-- </a>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
        <div class="post-meta-more"><a href="<?php echo Url::to(['view', 'id' => $model['id']]) ?>" target="_blank">Read More <i class="fa fa-chevron-right"></i></a></div>
    </div>
</div>