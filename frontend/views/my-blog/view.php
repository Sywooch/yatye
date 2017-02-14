<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

if ($model->status == Yii::$app->params['draft']) :
    $this->title = 'Draft - ' . $model->title;
else:
    $this->title = $model->title;
endif;


//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/my-blog']) ?>">My Blog</a></li>
            <li class="active"><a href="#"><?php echo $model->title; ?></a></li>
        </ol>
    </div>
    <div class="row">
        <?php $data = $this->context->accessData();
        echo $this->render('@app/views/layouts/_side_bar', ['data' => $data]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="page-title">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>

                <div class="posts post-detail">

                    <?php if ($model->image != ''): ?>
                        <img src="<?php echo Yii::$app->params['blog_images'] . $model->image; ?>"
                             alt="<?php echo $model->title; ?>"
                             style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px;'>
                    <?php endif; ?>


                    <div class="post-meta clearfix">
                        <div class="post-meta-author">By <a href="#">Eric Yorick</a></div>
                        <div class="post-meta-date"><?php echo date('D d M, Y', strtotime($model->updated_at)); ?></div>
                        <div class="post-meta-author"><i class="fa fa-edit"></i> <a
                                href="<?php echo Url::to(['update', 'id' => $model->id]) ?>"> Edit</a></div>
                        <div class="post-meta-author"><i class="fa fa-caret-square-o-up"></i>
                            <a href="<?php echo Url::to(['publish', 'id' => $model->id]) ?>">
                                <?php if ($model->status == Yii::$app->params['draft'] || $model->status == Yii::$app->params['unpublish']) : ?>
                                    Publish
                                <?php else: ?>
                                    Unpublish
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-meta-comments">
                            <?php $count = $model->getNumberOfComments(); if (!empty($count)): ?>
                                <i class="fa fa-comments"></i>
                                <a href="#"><?php echo ($count > 1) ? $count . ' comments' : $count . ' comment' ?> </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="post-content">
                        <p class='drop-cap'><?= nl2br($model->introduction) ?></p>
                        <p><?= nl2br($model->content) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
