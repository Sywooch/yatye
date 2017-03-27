<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 8:00 PM
 */
?>
<div class="detail-follow">
    <?php foreach ($socials as $social):
        if ($social->type == Yii::$app->params['FACEBOOK']): ?>
            <a class="follow-btn facebook" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-facebook"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['YOUTUBE']): ?>
            <a class="follow-btn youtube" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-youtube"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['TWITTER']): ?>
            <a class="follow-btn twitter" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-twitter"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['GOOGLE_PLUS']): ?>
            <a class="follow-btn google-plus" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-google-plus"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['INSTAGRAM']): ?>
            <a class="follow-btn instagram" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-instagram"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['PINTREST']): ?>
            <a class="follow-btn pinterest" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-pinterest"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['FLICKLR']): ?>
            <a class="follow-btn flickr" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-flickr"></i></a>
        <?php endif;
        if ($social->type == Yii::$app->params['TRIPADVISOR']): ?>
            <a class="follow-btn tripadvisor" href="<?php echo $social->name; ?>"
               target="_blank"><i class="fa fa-tripadvisor"></i></a>
        <?php endif;
    endforeach; ?>
</div>
