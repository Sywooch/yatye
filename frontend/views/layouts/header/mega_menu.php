<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/5/17
 * Time: 9:44 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
?>

<li class="has-mega-menu">
    <a href="#">
        <span class="badge" style="background-color: #c6af5c;">
            <?php echo Yii::t('app', 'Useful links') ?>
        </span>
        <i class="fa fa-chevron-down"></i>
    </a>

    <ul class="mega-menu">
        <li>
            <a href="#"><?php echo Yii::t('app', 'About us') ?></a>

            <ul>
                <li>
                    <a href="<?php echo Url::to(['/about-us/whats-rwanda-guide']) ?>">
                        <?php echo Yii::t('app', "What's Rwanda Guide?") ?>
                    </a>
                </li>
                <li><a href="<?php echo Url::to(['/contact-us']) ?>"><?php echo Yii::t('app', 'Contact us') ?></a></li>
                <li><a href="<?php echo Url::to(['/pricing']) ?>"><?php echo Yii::t('app', 'Pricing') ?></a></li>
            </ul>
        </li>

        <li>
            <a href="#"><?php echo Yii::t('app', "User account") ?></a>

            <ul>
                <li><a href="<?php echo Url::to(['/user/security/login']) ?>"><?php echo Yii::t('app', "Login") ?></a></li>
                <li><a href="<?php echo Url::to(['/place/create']) ?>"><?php echo Yii::t('app', "Submit Listing") ?></a></li>
                <li><a href="<?php echo Url::to(['/event/create']) ?>"><?php echo Yii::t('app', "Submit Events") ?></a></li>
            </ul>
        </li>

        <li>
            <a href="#"><?php echo Yii::t('app', "Posts") ?></a>

            <ul>
                <li><a href="<?php echo Url::to(['/post-type/about-rwanda']) ?>"><?php echo Yii::t('app', "About Rwanda") ?></a></li>
                <li><a href="<?php echo Url::to(['/post-type/news']) ?>"><?php echo Yii::t('app', "News") ?></a></li>
                <li><a href="<?php echo Url::to(['/post-type/blog']) ?>"><?php echo Yii::t('app', "Blog") ?></a></li>
            </ul>
        </li>

        <li>
            <a href="#"><?php echo Yii::t('app', "Miscellaneous") ?></a>

            <ul>
                <li><a href="<?php echo Url::to(['/upcoming-event']) ?>"><?php echo Yii::t('app', "Upcoming Events") ?></a></li>
                <li><a href="<?php echo Url::to(['/filter']) ?>"><?php echo Yii::t('app', "Filter") ?></a></li>
                <li><a href="https://www.eyeem.com/u/rwandaguide"><?php echo Yii::t('app', "Gallery") ?></a></li>
            </ul>
        </li>
    </ul>
</li>
