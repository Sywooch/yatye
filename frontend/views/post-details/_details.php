<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/2/17
 * Time: 8:54 PM
 */
/* @var $model backend\models\post\Post */
?>

<div class="col-sm-8 col-lg-9">
    <div class="content">
        <div class="page-title">
            <h1><?php echo $model->title; ?></h1>
        </div>

        <div class="posts post-detail">
            <?php if ($model->image != ''): ?>
                <img src="<?php echo $model->getPostPicture(); ?>" alt="<?php echo $model->title; ?>"
                     class="img-alt img-responsive">
            <?php endif; ?>

            <div class="post-meta clearfix div">
                <div class="post-meta-date">
                    <i class="fa fa-clock-o"></i>
                    <?php echo $model->getLastUpdatedDate(); ?>
                </div>
                <div class="post-meta-categories">
                    <i class="fa fa-tags"></i>
                    <a href="<?php echo $model->getPostCategoryUrl(); ?>"><?php echo $model->getPostCategoryName(); ?></a>
                </div>
                <div class="post-meta-categories">
                    <div class="fb-share-button"
                         data-href="http://rwandaguide.info/<?php echo Yii::$app->request->getUrl() ?>"
                         data-layout="button_count"></div>
                </div>
                <div class="post-meta-categories">
                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
                </div>
                <div class="post-meta-categories">
                    <div class="g-plus" data-action="share" data-annotation="bubble"></div>
                </div>
                <div class="post-meta-categories">
                    <a href="https://www.pinterest.com/pin/create/button/">
                        <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/>
                    </a>
                </div>
            </div>

            <div class="post-content background-white p30 div">
                <p class='drop-cap'><?= nl2br($model->introduction) ?></p>
                <?= nl2br($model->content) ?>

            </div>

<!--            <div class="post-meta-tags clearfix">-->
<!--                Tags:-->
<!--                <ul>-->
<!--                    <li class="tag"><a href="#">Coffee</a></li>-->
<!--                    <li class="tag"><a href="#">Breakfast</a></li>-->
<!--                    <li class="tag"><a href="#">Wine</a></li>-->
<!--                    <li class="tag"><a href="#">Healthy Food</a></li>-->
<!--                    <li class="tag"><a href="#">Raw Food</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</div>
