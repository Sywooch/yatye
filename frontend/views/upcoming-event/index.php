<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
?>

<div class="container">
    <div class="row detail-content">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="page-title">
                    <h1><?php echo $model->name; ?></h1>
                </div>
                <div class="posts post-detail background-white p20 div row">
                    <div class="col-md-6 col-lg-6">
                        <?php if ($model->banner != null) { ?>
                            <a href="#">
                                <img class="img-responsive img-alt" alt="<?php echo $model->name ?>"
                                     src="<?php echo $model->getBanner() ?>">

                            </a>
                        <?php } else { ?>
                            <div class="cards-wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <h2><a href="#"><?php echo $model->name ?></a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-6 col-lg-6 p30">
                        <div class="row">
                            <?php if (!empty($contacts)): ?>
                                <?php echo $this->render('_contact', [
                                    'model' => $model,
                                    'contacts' => $contacts,
                                ]); ?>
                            <?php endif; ?>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <?php if (!empty($socials)): ?>
                                <?php echo $this->render('_social', [
                                    'model' => $model,
                                    'socials' => $socials,
                                ]); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="post-meta clearfix div">
                        <div class="post-meta-date"><i>Start </i> : <?php echo $model->getDate($model->start_date); ?>
                            <?php echo ($model->start_time != null) ? 'at ' . date('H:i', strtotime($model->start_time)) : ''; ?>
                        </div>
                        <div class="post-meta-date"><i>End </i> : <?php echo $model->getDate($model->end_date); ?>
                            <?php echo ($model->end_time != null) ? 'at ' . date('H:i', strtotime($model->end_time)) : ''; ?>
                        </div>
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
                                <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/>
                            </a>
                        </div>
                    </div>

                    <?php if ($model->description != '' || $model->description != null): ?>
                        <div class="post-content">
                            <p class='drop-cap'><?= nl2br($model->description) ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="post-meta-tags clearfix">
                        <?php if (!empty($event_tags)): ?>
                            <ul>
                                <?php foreach ($event_tags as $event_tag): ?>
                                    <li class="tag"><a href="#"><?php echo $event_tag->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!--Location-->
                <?php if ($model->latitude != null && $model->longitude != null) : ?>
                    <?php echo $this->render('_location', [
                        'model' => $model,
                    ]); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
