<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 7:30 PM
 */
?>

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
                <i class="fa fa-skype"></i> <a href="<?php echo $contact->name ?>"><?php echo $contact->name ?></a>
            </div>
        <?php endif; ?>
        <?php if ($contact->type === Yii::$app->params['WEBSITE']): ?>
            <div class="detail-contact-website">
                <i class="fa fa-globe"></i> <a href="<?php echo $contact->name ?>" target="_blank">Visit website</a>
            </div>
        <?php endif; ?>

    <?php endforeach; ?>
</div>
