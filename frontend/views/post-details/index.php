<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = $model->title;
?>
    <div class="col-sm-8 col-lg-9">
        <div class="content">
            <div class="page-title">
                <h1><?php echo $model->title; ?></h1>
            </div>

            <div class="posts post-detail">

                <?php if($model->image != ''): ?>
                    <img src="<?php echo Yii::$app->params['post_images'] . $model->image; ?>" alt="<?php echo $model->title;?>" style=' width: 100%; "Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px;'>
                <?php endif; ?>


                <div class="post-meta clearfix div">
                    <div class="post-meta-date"><i class="fa fa-clock-o"></i><?php echo date('D d M, Y',strtotime($model->getUpdatedAt()));?></div>
                    <div class="post-meta-categories"><i class="fa fa-tags"></i> <a href="<?php echo Yii::$app->request->baseUrl . '/post-category/' . $post_category->slug; ?>"><?php echo $post_category->name;?></a></div>
                    <div class="post-meta-categories">
                        <div class="fb-share-button" data-href="http://rwandaguide.info/<?php echo  Yii::$app->request->getUrl() ?>" data-layout="button_count"></div>
                    </div>
                    <div class="post-meta-categories">
                        <a class="twitter-share-button" href="https://twitter.com/intent/tweet">Tweet</a>
                    </div>
                    <div class="post-meta-categories">
                        <div class="g-plus" data-action="share" data-annotation="bubble"></div>
                    </div>
                    <div class="post-meta-categories">
                        <a href="https://www.pinterest.com/pin/create/button/">
                            <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" />
                        </a>
                    </div>
                </div>

                <div class="post-content background-white p30 div">
                    <p class='drop-cap'><?= nl2br($model->introduction) ?></p>
                    <?= nl2br($model->content) ?>
                </div>
            </div>


        </div>
    </div>
<?php echo $this->render('@app/views/layouts/_right_side') ?>