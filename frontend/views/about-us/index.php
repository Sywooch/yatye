<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = Yii::t('app', 'About Rwanda Guide');
?>
<div class="container">
    <div class="row">
        <!-- _left_side_about_us -->
        <?php echo $this->render('_left_side_about_us', [
            'about_us_posts' => $about_us_posts,
        ]); ?>
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="page-title">
                    <h1><?php echo Html::encode($model->title) ?></h1>
                </div>

                <div class="posts post-detail background-white p30 mb30 div">
                    <?php if($model->image != ''): ?>
                        <img src="<?php echo Yii::$app->params['post_images'] . $model->image; ?>" alt="<?php echo $model->title;?>" style=' width: 100%; "Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px;'>
                    <?php endif; ?>
                    <div class="post-content">
                        <p class='drop-cap'><?= nl2br($model->introduction) ?></p>
                        <?= nl2br($model->content) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
