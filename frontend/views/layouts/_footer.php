<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2015
 * Time: 23:13
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<footer class="footer  p30 row div">
    <?php //echo $this->render('@app/views/layouts/_footer_top') ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-left">
                &copy; <?php echo Yii::t('app', 'Copyright 2015') ?> - <?php echo date('Y') ?> <?php echo Yii::t('app', 'All rights reserved.') ?>
                <a href="http://rwandaguide.info/" style="color: #c6af5c;"><?php echo Yii::$app->name ?></a>
            </div>
            <div class="footer-bottom-right">
                <ul class="nav nav-pills">
                    <li><a href="<?php echo Yii::$app->params['root'] ?>"><?php echo Yii::t('app', 'Home') ?></a></li>
                    <li><?php echo Html::a(Yii::t('app', 'About us'), Url::to(['/about-us/whats-rwanda-guide'])) ?></li>
                    <li><?php echo Html::a(Yii::t('app', 'Contact us'), Url::to(['/contact-us'])) ?></li>
                    <li><?php echo Html::a('Pricing', Url::to(['/pricing'])) ?></li>
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li><?php echo Html::a(Yii::t('app', 'Login'), ['/user/security/login']) ?></li>
                    <?php } else { ?>
                        <li><?php echo Html::a(Yii::$app->user->identity->username, ['/dashboard']) ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
