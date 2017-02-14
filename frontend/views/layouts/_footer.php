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
<footer class="footer">
<!--    <div class="footer-top visible-md visible-lg" style="padding: 15px;" >-->
<!--        <div class="row">-->
<!--            <div class="col-sm-3">-->
<!--                <a data-pin-do="embedUser" data-pin-board-width="370" data-pin-scale-height="230"-->
<!--                   data-pin-scale-width="115" href="https://www.pinterest.com/rwandaguide/"></a>-->
<!--            </div>-->
<!---->
<!--            <div class="col-sm-3">-->
<!--                <div class="fb-like" data-href="https://web.facebook.com/rwandaguide.info/" data-layout="standard"-->
<!--                     data-action="like" data-show-faces="false" data-share="true"></div>-->
<!---->
<!--                <div class="fb-page" data-href="https://www.facebook.com/rwandaguide.info/" data-tabs="timeline"-->
<!--                     data-width="280" data-height="320" data-small-header="true" data-adapt-container-width="false"-->
<!--                     data-hide-cover="true" data-show-facepile="false">-->
<!--                    <blockquote cite="https://www.facebook.com/rwandaguide.info/" class="fb-xfbml-parse-ignore"><a-->
<!--                            href="https://www.facebook.com/rwandaguide.info/">Rwanda Guide</a></blockquote>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="col-sm-3">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
<!--                        <a href="https://twitter.com/rwandaguide_" class="twitter-follow-button"-->
<!--                           data-show-count="false" data-dnt="true">Follow @rwandaguide_</a>-->
<!--                        <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/rwandaguide_"-->
<!--                           data-widget-id="724265366227193856">Tweets by @rwandaguide_</a>-->
<!--                        <script>!function (d, s, id) {-->
<!--                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';-->
<!--                                if (!d.getElementById(id)) {-->
<!--                                    js = d.createElement(s);-->
<!--                                    js.id = id;-->
<!--                                    js.src = p + "://platform.twitter.com/widgets.js";-->
<!--                                    fjs.parentNode.insertBefore(js, fjs);-->
<!--                                }-->
<!--                            }(document, "script", "twitter-wjs");</script>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-sm-3">-->
<!--                <!-- Place this tag where you want the widget to render. -->-->
<!--                <div class="g-page" data-width="280" data-href="//plus.google.com/u/0/110093583439725047827"-->
<!--                     data-showtagline="false" data-rel="publisher"></div>-->
<!---->
<!--                <!-- Place this tag after the last widget tag. -->-->
<!--                <script type="text/javascript">-->
<!--                    (function () {-->
<!--                        var po = document.createElement('script');-->
<!--                        po.type = 'text/javascript';-->
<!--                        po.async = true;-->
<!--                        po.src = 'https://apis.google.com/js/platform.js';-->
<!--                        var s = document.getElementsByTagName('script')[0];-->
<!--                        s.parentNode.insertBefore(po, s);-->
<!--                    })();-->
<!--                </script>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-left">
                &copy; <?php echo Yii::t('app', 'Copyright 2015') ?> - <?php echo date('Y') ?> <?php echo Yii::t('app', 'All rights reserved.') ?>
                <a href="http://rwandaguide.info/" style="color: #c6af5c;"><?php echo Yii::$app->name ?></a>
            </div>
            <div class="footer-bottom-right">
                <ul class="nav nav-pills">
                    <li><a href="<?php echo Yii::$app->params['root'] ?>"><?php echo Yii::t('app', 'Home') ?></a></li>
<!--                    <li>--><?php //echo Html::a(Yii::t('app', 'About us'), Url::to(['/about-us/whats-rwanda-guide'])) ?><!--</li>-->
                    <li><?php echo Html::a(Yii::t('app', 'Contact'), Url::to(['/contact-us'])) ?></li>
<!--                    <li>--><?php //echo Html::a('Pricing', Url::to(['/pricing'])) ?><!--</li>-->
                    <li><?php echo Html::a(Yii::t('app', 'Terms &amp; Conditions'), Url::to(['/site/terms-conditions'])) ?></li>
                    <li><?php echo Html::a(Yii::t('app', 'Privacy Policy'), Url::to(['/site/privacy-policy'])) ?></li>
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
