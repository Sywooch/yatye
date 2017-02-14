<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Blog - ' . $model->title;
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>/blog">Blog</a></li>
            <li class="active"><a href="#"><?php echo $model->title ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="page-title">
                    <h1><?php echo $model->title ?></h1>
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

                        <div class="post-meta-comments">
                            <?php $count = $model->getNumberOfComments(); if (!empty($count)): ?>
                                <i class="fa fa-comments"></i>
                                <a href="#"><?php echo ($count > 1) ? $count . ' comments' : $count . ' comment' ?> </a>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div class="post-content">
                        <p><?= nl2br($model->content) ?></p>
                    </div>

                    <?php if (!empty($comments)) : ?>
                        <h2 id="reviews"><?php echo count($comments) ?> Comments</h2>
                        <?php foreach ($comments as $comment): ?>
                            <div class="comments">
                                <div class="comment background-white p20">
                                    <div class="comment-header">
                                        <h2><?php echo $comment->full_name ?></h2>
                                        <span class="separator">&#8226;</span>
                                        <span
                                            class="comment-date"><?php echo date('D d M, Y', strtotime($comment->created_at)); ?></span>
                                    </div>
                                    <div class="comment-content-wrapper">
                                        <div class="comment-content">
                                            <p><?php echo $comment->comment ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <? //= LinkPager::widget(['pagination' => $pagination]) ?>
                    <?php endif; ?>


                    <h2>Write a Comment</h2>

                    <div class="background-white p20 add-comment">
                        <p>Required fields are marked <span class="required">*</span></p>
                        <?php $form = ActiveForm::begin([
//                            'action' => Url::to(['/blog/comment', 'id' => $model->id]),
                            'action' => Yii::$app->request->baseUrl . '/blog/comment/?id=' . $model->id,
                        ]); ?>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="">Review <span class="required">*</span></label>
                                <?= $form->field($review, 'comment')->textArea(['rows' => 6])->label(false) ?>
                            </div>

                            <?php if (!Yii::$app->user->isGuest) : ?>

                                <?= $form->field($review, 'full_name')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>
                                <?= $form->field($review, 'email')->hiddenInput(['value' => Yii::$app->user->identity->email])->label(false) ?>

                            <?php else : ?>
                                <div class="form-group col-sm-6">
                                    <label for="">Name <span class="required">*</span></label>
                                    <?= $form->field($review, 'full_name')->textInput()->label(false) ?>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="">Email <span class="required">*</span></label>
                                    <?= $form->field($review, 'email')->textInput()->label(false) ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group col-sm-4 pull-right">
                                <?= Html::submitButton(Html::tag('i ', ' Post Comment', ['class' => 'fa fa-comments']), ['class' => 'btn btn-primary btn-block']) ?>
                            </div>

                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
