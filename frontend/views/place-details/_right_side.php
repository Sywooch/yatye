<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/12/2016
 * Time: 16:22
 */

use yii\helpers\Url;

?>

<?php echo $this->render('_top', [
    'model' => $model,
    'views' => $views,
    'ratings' => $ratings,
]); ?>

<?php if ($model->profile_type == Yii::$app->params['FREE'] && $model->description != null) : ?>
    <h2>About <span class="text-secondary"><?php echo $model->name ?></span></h2>
    <div class="background-white p20 div">
        <?php if ($model->description != null): ?>
            <div class="detail-description"><?php echo $model->description ?></div>
        <?php endif; ?>
    </div>
<?php elseif ($model->profile_type == Yii::$app->params['PREMIUM'] || $model->profile_type == Yii::$app->params['BASIC']) : ?>
    <h2>About <span class="text-secondary"><?php echo $model->name ?></span></h2>
    <div class="background-white p20 div">
        <div class="detail-vcard">
            <div class="detail-logo">
                <img alt="<?php echo $model->name ?>"
                     src="<?php echo $model->getPhoto() ?>"
                     class="img-responsive img-alt">
            </div>
            <div class="detail-contact">
                <?php if ($model->neighborhood != null): ?>
                    <div class="detail-contact-address">
                        <i class="fa fa-map-o"></i><?php echo $model->neighborhood ?>
                    </div>
                <?php endif; ?>
                <?php if ($model->street != null): ?>
                    <div class="detail-contact-address">
                        <i class="fa fa-location-arrow"></i><?php echo $model->street ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($contacts)): ?>

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
                <?php endif; ?>
            </div>
        </div>
        <?php if ($model->description != null): ?>
            <div class="detail-description"><?php echo nl2br($model->description) ?></div>
        <?php endif; ?>
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
<?php endif; ?>

<!--Working Hours-->
<?php if (!empty($working_hours)): ?>
    <div class="widget">
        <h2 class="widgettitle">Working Hours</h2>

        <div class="p20 background-white div">
            <div class="working-hours">

                <?php foreach ($working_hours as $working_hour): if ($working_hour->opening_time != null):
                    if ($working_hour->closed == 'no') { ?>
                        <div class="day clearfix">
                            <span class="name"><?php echo $working_hour->day; ?></span><span
                                    class="hours"><?php echo date('H:i', strtotime($working_hour->opening_time)); ?>
                                - <?php echo date('H:i', strtotime($working_hour->closing_time)); ?></span>
                        </div>
                    <?php } else { ?>
                        <div class="day clearfix">
                            <span class="name"><?php echo $working_hour->day; ?></span><span
                                    class="hours">Closed</span>
                        </div>
                    <?php } endif; endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Services & Amenities-->
<?php if (!empty($amenities)): ?>
    <h2>Services & Amenities</h2>
    <div class="background-white p20 div">
        <ul class="detail-amenities">
            <?php foreach ($amenities as $amenity): ?>
                <li class="yes">
                    <a href="<?php echo Url::to(['/service/' . $amenity['slug']]) ?>"><?php echo $amenity['name'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Enquiry form-->
<?php if ($model->profile_type == Yii::$app->params['PREMIUM'] || $model->profile_type == Yii::$app->params['BASIC']) : ?>
    <?php echo $this->render('_enquiry_form', [
        'model' => $model,
        'contact_form' => $contact_form,
    ]); ?>
<?php endif; ?>