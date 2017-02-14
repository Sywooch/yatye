<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:15
 */
?>

<div class="block background-white mt50 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Most recent News & Articles') ?></h1>
        <p>Check what's going on in the country</p>
    </div>
    <div class="row">
        <!--Articles-->
        <?php if (!empty($articles)): ?>
            <div class="col-sm-6">
                <div class="posts">
                    <?php foreach ($articles as $article):
                        $post_category= $article->getPostCategory();
                        ?>

                        <div class="post text-left">

                            <?php if ($article->image != null): ?>
                                <div class="post-image">
                                    <img src="<?php echo Yii::$app->params['post_thumbnails'] . $article->image; ?>"
                                         alt="<?php echo $article->title; ?>" style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 16px;'>
                                    <a class="read-more" href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $article->slug; ?>" target="_blank">View</a>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <div class="post-label"><?php echo $post_category->name ?></div>
                                <div class="post-date"><?php echo date('D d M, Y',strtotime($article->getUpdatedAt())); ?></div>
                                <h2><?php echo $article->title ?></h2>
                                <p><?= nl2br(substr($article->introduction, 0, 255)) ?> <a href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $article->slug; ?>" target="_blank">Read more</a></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!--News-->
        <?php if (!empty($news)): ?>
            <div class="col-sm-6">
                <div class="posts">
                    <?php foreach ($news as $new):
                        $post_category= $new->getPostCategory();
                        ?>
                        <div class="post text-left">
                            <?php if ($new->image != null): ?>
                                <div class="post-image">
                                    <img src="<?php echo Yii::$app->params['post_thumbnails'] . $new->image; ?>"
                                         alt="<?php echo $new->title; ?>" style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 16px;'>
                                    <a class="read-more" href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $new->slug; ?>" target="_blank">View</a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <!--                                    <div class="post-label">--><?php //echo $post_category->name ?><!--</div>-->
                                <div class="post-date"><?php echo date('D d M, Y',strtotime($new->getUpdatedAt())); ?></div>
                                <h2><a href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $new->slug; ?>" target="_blank"><?php echo $new->title ?> </a></h2>
                                <p><?= nl2br(substr($new->introduction, 0, 255)) ?> <a href="<?php echo Yii::$app->request->baseUrl . '/post-details/' . $new->slug; ?>" target="_blank">Read more</a></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
