<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:15
 */
/* @var $article backend\models\post\Post */
/* @var $new backend\models\post\Post */
?>

<div class="block background-white mt50 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Most recent News & Blog') ?></h1>
        <p>Check what's going on in the country</p>
    </div>
    <div class="row">
        <!--Articles-->
        <?php if (!empty($articles)): ?>
            <div class="col-sm-6">
                <div class="posts">
                    <?php foreach ($articles as $article):?>
                        <div class="post text-left">
                            <?php if ($article->image != null): ?>
                                <div class="post-image">
                                    <img src="<?php echo $article->getPostThumbnails() ?>"
                                         alt="<?php echo $article->title; ?>"
                                         class="img-alt img-responsive">
                                    <a class="read-more" href="<?php echo $article->getPostCategoryUrl(); ?>" target="_blank">View</a>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <div class="post-label"><?php echo $article->getPostCategoryName() ?></div>
                                <div class="post-date"><?php echo $article->getLastUpdatedDate(); ?></div>
                                <h2><?php echo $article->title ?></h2>
                                <p>
                                    <?= nl2br(substr($article->introduction, 0, 255)) ?>
                                    <a href="<?php echo $article->getPostUrl(); ?>" target="_blank">Read more</a>
                                </p>
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
                    <?php foreach ($news as $new):?>
                        <div class="post text-left">
                            <?php if ($new->image != null): ?>
                                <div class="post-image">
                                    <img src="<?php echo $new->getPostThumbnails(); ?>"
                                         alt="<?php echo $new->title; ?>"
                                         class="img-alt img-responsive">
                                    <a class="read-more" href="<?php echo $new->getPostUrl(); ?>" target="_blank">View</a>
                                </div>
                            <?php endif; ?>

                            <div class="post-content">
                                <div class="post-label"><?php echo $new->getPostCategoryName() ?></div>
                                <div class="post-date"><?php echo $new->getLastUpdatedDate(); ?></div>
                                <h2>
                                    <a href="<?php echo $new->getPostUrl(); ?>" target="_blank"><?php echo $new->title ?> </a>
                                </h2>
                                <p>
                                    <?= nl2br(substr($new->introduction, 0, 255)) ?>
                                    <a href="<?php echo $new->getPostUrl(); ?>" target="_blank">Read more</a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
