<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 10:26 AM
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<ul class="header-nav-secondary nav nav-pills">
    <li><?php echo Html::a('About Rwanda', Url::to(['/post-type/about-rwanda'])) ?></li>
    <li><?php echo Html::a('Blog', Url::to(['/post-type/blog'])) ?></li>
    <li><?php echo Html::a('News', Url::to(['/post-type/news'])) ?></li>
    <li><?php echo Html::a('Events', Url::to(['/upcoming-event'])) ?></li>
    <li><a href="https://www.eyeem.com/u/rwandaguide" target="_blank" title="Gallery">Gallery</a></li>
    <?php if (Yii::$app->user->isGuest) { ?>
        <li><?php echo Html::a(Yii::t('app', 'Login'), ['/user/security/login']) ?></li>
    <?php } else { ?>
        <li><?php echo Html::a(Yii::$app->user->identity->username, ['/dashboard']) ?></li>
    <?php } ?>
</ul>
<ul class="header-nav-social social-links nav nav-pills">
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['twitter'] ?>"
           target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['facebook'] ?>"
           target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['google-plus'] ?>"
           target="_blank" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['linkedin'] ?>"
           target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['tumblr'] ?>"
           target="_blank" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['instagram'] ?>"
           target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['pinterest'] ?>"
           target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['flickr'] ?>"
           target="_blank" title="Flickr"><i class="fa fa-flickr"></i></a></li>
    <li><a data-toggle="tooltip" data-placement="bottom" href="<?php echo Yii::$app->params['youtube'] ?>"
           target="_blank" title="Youtube"><i class="fa fa-youtube" style="background-color: #e62117;"></i></a></li>
</ul>
