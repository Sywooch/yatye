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
                <div class="posts post-detail background-white p20 div">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="detail-gallery">
                            <?php if ($model->banner != null) { ?>
                                <div class="detail-gallery-preview">
                                    <div class="row">
                                        <a href="#">
                                            <img alt="<?php echo $model->name ?>"
                                                 style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px; width: 652px;'
                                                src="<?php echo Yii::$app->params['event_images'] . $model->banner ?>">

                                        </a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="detail-gallery-preview">
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
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="row">
                            <div class="detail-vcard">
                                <?php if (!empty($contacts)): ?>
                                    <div class="detail-contact">
                                        <?php foreach ($contacts as $contact): ?>
                                            <?php if ($contact->type === Yii::$app->params['PHYSICAL_ADDRESS']): ?>
                                                <div class="detail-contact-address">
                                                    <i class="fa fa-location-arrow"></i> <a
                                                            href="#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['PO_BOX']): ?>
                                                <div class="detail-contact-phone">
                                                    <i class="fa fa-at"></i> <a
                                                            href="#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['MOB_PHONE']): ?>
                                                <div class="detail-contact-phone">
                                                    <i class="fa fa-mobile-phone"></i> <a
                                                            href="#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['LAND_LINE']): ?>
                                                <div class="detail-contact-phone">
                                                    <i class="fa fa-phone"></i> <a
                                                            href="#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['FAX']): ?>
                                                <div class="detail-contact-phone">
                                                    <i class="fa fa-fax"></i> <a
                                                            href="#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['EMAIL']): ?>
                                                <div class="detail-contact-email">
                                                    <i class="fa fa-envelope-o"></i> <a
                                                            href="mailto:#"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['SKYPE']): ?>
                                                <div class="detail-contact-skype">
                                                    <i class="fa fa-skype"></i> <a
                                                            href="<?php echo $contact->name ?>"><?php echo $contact->name ?></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($contact->type === Yii::$app->params['WEBSITE']): ?>
                                                <div class="detail-contact-website">
                                                    <i class="fa fa-globe"></i> <a
                                                            href="<?php echo $contact->name ?>">Visit website</a>
                                                </div>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($socials)): ?>
                                <div class="detail-follow">
                                    <h5>Follow Us:</h5>

                                    <div class="follow-wrapper">
                                        <?php foreach ($socials as $social):
                                            if ($social->type == Yii::$app->params['FACEBOOK']): ?>
                                                <a class="follow-btn facebook" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-facebook"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['YOUTUBE']): ?>
                                                <a class="follow-btn youtube" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-youtube"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['TWITTER']): ?>
                                                <a class="follow-btn twitter" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-twitter"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['GOOGLE_PLUS']): ?>
                                                <a class="follow-btn google-plus" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-google-plus"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['INSTAGRAM']): ?>
                                                <a class="follow-btn instagram" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-instagram"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['PINTREST']): ?>
                                                <a class="follow-btn pinterest" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-pinterest"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['FLICKLR']): ?>
                                                <a class="follow-btn flickr" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-flickr"></i></a>
                                            <?php endif;
                                            if ($social->type == Yii::$app->params['TRIPADVISOR']): ?>
                                                <a class="follow-btn tripadvisor" href="<?php echo $social->name; ?>"
                                                   target="_blank"><i
                                                            class="fa fa-tripadvisor"></i></a>
                                            <?php endif;
                                        endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <br>
                            <br>
                            <div class="col-md-3 col-lg-3">
                                <p class="calendar" style="font:bold 30px/60px Arial Black,Arial,Helvetica,sans-serif;">
                                    15<em>March</em>
                                </p>
                            </div>
                            <div class="col-md-9 col-lg-9">
                                Start : <?php echo date('D d M, Y', strtotime($model->start_at)); ?><br>
                                End : <?php echo date('D d M, Y', strtotime($model->end_at)); ?>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($tags)): ?>
                        <div class="post-meta-tags clearfix">
                            <ul>
                                <?php foreach ($tags as $tag): ?>
                                    <li class="tag"><a href="#"><?php echo $tag['name']; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="post-content">
                        <p class='drop-cap'><?= nl2br($model->description) ?></p>
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
