<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Blog';
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="#"><?= Html::encode($this->title) ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="page-title">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <?php if (!empty($blogs)): ?>
                    <div class="posts">
                        <?php foreach ($blogs as $blog): ?>
                            <div class="post">
                                <?php if ($blog->image != ''): ?>
                                    <div class="post-image">
                                        <img src="<?php echo Yii::$app->params['blog_thumbnails'] . $blog->image; ?>"
                                             alt="<?php echo $blog->title; ?>" style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 16px;'>
                                        <a class="read-more" href="<?php echo Yii::$app->request->baseUrl . '/blog/' . $blog->slug; ?>">View</a>
                                    </div>
                                <?php endif; ?>
                                <div class="post-content">
                                    <h2><a href="<?php echo Yii::$app->request->baseUrl . '/blog/' . $blog->slug; ?>"><?php echo $blog->title; ?><a></h2>
                                    <p><?= nl2br(substr($blog->content, 0, 500)) ?> ...</p>
                                </div>

                                <div class="post-meta clearfix">
                                    <div class="post-meta-date"><i class="fa fa-clock-o"></i> Last update
                                        : <?php echo date('D d M, Y',strtotime($blog->updated_at)); ?></div>
                                    <div class="post-meta-comments">
                                        <?php $count = $blog->getNumberOfComments(); if (!empty($count)): ?>
                                            <i class="fa fa-comments"></i>
                                            <a href="#"><?php echo ($count > 1) ? $count . ' comments' : $count . ' comment' ?> </a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="post-meta-more">
                                        <a href="<?php echo Yii::$app->request->baseUrl . '/blog/' . $blog->slug; ?>">Read More <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="pager">
                        <?= LinkPager::widget(['pagination' => $pagination]) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
