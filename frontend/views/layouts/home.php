<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"
      itemscope itemtype="http://schema.org/Website">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Rwanda Guide"/>
    <meta name="description"
          content="Have you ever been to Rwanda? Want to visit and don't know where to start? Don't worry, we got your back."/>
    <meta name="classification"
          content="This website will help you find more information about a place you would like to visit. This website also helps businesses reach out to potential clients about their services.">
    <meta name="geography" content="Rwanda Kigali">
    <meta name="keywords" content="Places to visit, Places to stay, Places to eat, Things to do, Amenities, Services
                Rwanda, Kigali, Umuganura, Kwibuka, Kwita izina, Akagera National Park,
                Kalisimbi, Muhabura, Kigali City Tower, KCT, UTC, Sabyinyo, Gorillas,
                Nyungwe, Hotels, Apartments, Restaurants, Before you make the move,"/>
    <meta name="robots" content="index, follow"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="English"/>
    <meta name="revisit-after" content="2 days"/>
    <meta name="author" content="Marius Ngaboyamahina"/>
    <meta name="google-site-verification" content="PSEIUTyoAIopuk7Q8t8B6M6WiF711Udi3dT1YE6LBFk"/>
    <meta name="copyright" content="Copyright <?php echo date('Y') ?> - Rwanda Guide">
    <meta name="designer" content="Marius Ngaboyamahina">
    <meta name="publisher" content="Rwanda Guide">
    <meta name="distribution" content="Global">
    <meta name="city" content="Kigali">
    <meta name="country" content="Rwanda">
    <meta name="subject" content="Website">
    <meta name="robots" content="index"/>
    <meta http-equiv="expires" content="30"/>
    <!--    <meta http-equiv="refresh" content="0; URL='http://rwandaguide.info" />-->


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Rwanda Guide">
    <meta itemprop="description"
          content="Rwanda Guide is a directory of fun places to explore for those visiting Rwanda or for locals to discover new places.">
    <meta itemprop="image" content="http://rwandaguide.info/frontend/web/files/images/RG.jpg">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@rwandaguide2015">
    <meta name="twitter:creator" content="@rwandaguide2015">
    <meta name="twitter:title" content="Rwanda Guide">
    <meta name="twitter:description"
          content="Rwanda Guide is a directory of fun places to explore for those visiting Rwanda or for locals to discover new places.">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="http://rwandaguide.info/frontend/web/files/images/RG.jpg">


    <!-- Open Graph data -->
    <meta property="og:title" content="Rwanda Guide">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://rwandaguide.info/">
    <meta property="og:image" content="http://rwandaguide.info/frontend/web/files/images/RG.jpg">
    <meta property="og:site_name" content="Rwanda Guide">
    <meta property="fb:app_id" content="1569960559930538">
    <meta property="og:description"
          content="Rwanda Guide is a directory of fun places to explore for those visiting Rwanda or for locals to discover new places.">
    <meta name="robots" content="index"/>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->params['icon_96']; ?>"/>
    <link rel="alternate" href="http://rwandaguide.info/" hreflang="x-default"/>
    <link rel="publisher" href="https://plus.google.com/u/0/110341479395654851118">

    <title><?= Html::encode($this->title) ?></title>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq)return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '1036660199717141');
        fbq('track', "PageView");</script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1036660199717141&ev=PageView&noscript=1"
        /></noscript>
    <!--End Facebook Pixel Code-->

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=1569960559930538";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


    <!-- Google Analytics -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-85801789-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- End Google Analytics -->


    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5NHZRF');</script>
    <!-- End Google Tag Manager -->




<!--    <script>-->
<!--        !function(){function c(){var a=b.createElement("script");-->
<!--            a.src='https://resend.io/widget.js',a.async=!0,a.onload=function(){__init('RAd1U2MEhUWFNuNGd5ZUE9PQ==')},-->
<!--                b.getElementsByTagName("head")[0].appendChild(a)}var a=window,b=document;-->
<!--            a.attachEvent?a.attachEvent("onload",c):a.addEventListener("load",c,!1)}();-->
<!--    </script>-->
<!---->
<!---->
<!--    <script type="text/javascript">-->
<!--        (function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = '//api.at.getsocial.io/widget/v1/gs_async.js?id=98b8b6'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })();-->
<!--    </script>-->

</head>
<body>

<?php $this->beginBody() ?>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=707256922715735";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NHZRF"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="page-wrapper">
    <div class="a">
        <div class="page-wrapper">
            <header class="header">
                <div class="header-wrapper">
                    <div class="container">
                        <div class="header-inner">
                            <div class="header-logo">
                                <a href="<?php echo Yii::$app->params['root'] ?>">
                                    <img
                                        style='width: 144px; "Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 24px;'
                                        src="<?php echo Yii::$app->params['logo_320'] ?>"
                                        alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>">
                                </a>
                            </div>
                            <div class="header-content">
                                <div class="header-top">
                                    <!--                                <div class="header-action">-->
                                    <!--                                    <a href="-->
                                    <?php //echo Yii::$app->request->baseUrl ?><!--/location"-->
                                    <!--                                       class="header-action-inner"-->
                                    <!--                                       title="Search by location"-->
                                    <!--                                       data-toggle="tooltip" data-placement="bottom">-->
                                    <!--                                        <i class="fa fa-search"></i>-->
                                    <!--                                    </a>-->
                                    <!--                                </div>-->
                                    <ul class="header-nav-secondary nav nav-pills">
                                        <li><?= Html::a('About Rwanda', Url::to(['/post-category/about-rwanda'])) ?></li>
                                        <li><?= Html::a('Rwanda for the first time', Url::to(['/post-category/before-you-make-the-move'])) ?></li>
                                        <li><?= Html::a('News', Url::to(['/post-type/news'])) ?></li>
                                        <li><a href="https://www.eyeem.com/u/rwandaguide" target="_blank"
                                               title="Gallery">Gallery</a></li>
                                        <?php if (Yii::$app->user->isGuest) { ?>
                                            <li><?php echo Html::a(Yii::t('app', 'Login'), ['/user/security/login']) ?></li>
                                        <?php } else { ?>
                                            <li><?php echo Html::a('My account (' . Yii::$app->user->identity->username . ')', ['/dashboard']) ?></li>
                                        <?php } ?>
                                    </ul>
                                    <!--                                <div class="header-search" style="width: 304px;">-->
                                    <!---->
                                    <!--                                    --><?php //$form = ActiveForm::begin([
                                    ////                                'action' => Yii::$app->request->baseUrl . '/nearby-places',
                                    //                                        'type' => ActiveForm::TYPE_INLINE,
                                    //                                        'method' => 'get',
                                    //                                        'id' => 'nearby-places',
                                    //                                        'class' => 'form-search',
                                    //                                    ]); $place = $this->context->getPlace(); $categories = ArrayHelper::map($this->context->getAllCategories(), 'id', 'name');
                                    //
                                    //
                                    //                                    ?>
                                    <!---->
                                    <!--                                    <div class="form-group">-->
                                    <!--                                        --><?php
                                    //                                        echo $form->field($place, 'category_id')->dropDownList($categories, ['id' => 'category_id', 'prompt' => 'Category', 'class'=>'input-sm'])->label(false);
                                    //
                                    //                                        //                                $services = $this->context->getServices($place->category_id);
                                    //                                        //
                                    //                                        //                                $carray = array();
                                    //                                        //                                foreach ($services as $service => $val):
                                    //                                        //                                    $service_id = $val['id'];
                                    //                                        //                                    $service_name = $val['name'];
                                    //                                        //                                    array_push($carray, [$service_id => $service_name]);
                                    //                                        //                                endforeach;
                                    //                                        //
                                    //                                        //                                //I am basically inverting the indexes here
                                    //                                        //                                $new_array = array();
                                    //                                        //                                foreach ($carray as $i => $element):
                                    //                                        //                                    foreach ($element as $j => $sub_element) {
                                    //                                        //                                        $new_array[$j] = $sub_element;
                                    //                                        //                                    }
                                    //                                        //                                endforeach;
                                    //                                        //                                echo $form->field($place, 'service_id')->widget(DepDrop::className(), [
                                    //                                        //                                    'options' => ['id' => 'service_id', 'class'=>'input-sm'],
                                    //                                        //                                    'data' => $new_array,
                                    //                                        //                                    'pluginOptions' => [
                                    //                                        //                                        'depends' => ['category_id'],
                                    //                                        //                                        'placeholder' => Yii::t('app', 'Services'),
                                    //                                        //                                        'url' => Url::to(['/nearby-places/services'])
                                    //                                        //                                    ]
                                    //                                        //                                ])->label(false);
                                    //                                        //                                print_r($this->context->getDistances());
                                    //                                        echo $form->field($place, 'distance')->dropDownList($this->context->getDistances(), ['id' => 'distance', 'prompt' => 'Nearby places', 'class'=>'input-sm'])->label(false);
                                    //                                        ?>
                                    <!--                                    </div>-->
                                    <!---->
                                    <!--                                    --><?php //ActiveForm::end(); ?>
                                    <!--                                </div>-->
                                    <ul class="header-nav-social social-links nav nav-pills">
                                        <li><a href="<?php echo Yii::$app->params['twitter'] ?>" target="_blank"
                                               title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['facebook'] ?>" target="_blank"
                                               title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['google-plus'] ?>" target="_blank"
                                               title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                                        <!--                                    <li><a href="-->
                                        <?php //echo Yii::$app->params['linkedin']?><!--" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
                                        <li><a href="<?php echo Yii::$app->params['tumblr'] ?>" target="_blank"
                                               title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['instagram'] ?>" target="_blank"
                                               title="Instagram"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['pinterest'] ?>" target="_blank"
                                               title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['flickr'] ?>" target="_blank"
                                               title="Flickr"><i class="fa fa-flickr"></i></a></li>
                                        <li><a href="<?php echo Yii::$app->params['youtube'] ?>" target="_blank"
                                               title="Youtube"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <?php echo $this->render('@app/views/layouts/_messages') ?>
            <?= $content ?>
        </div><!-- /.page-wrapper -->
    </div>
    <?php
    //$this->registerJs("$(window).load(function () {
    //        $('.a').fadeIn(1000);
    //        var gutter = parseInt($('.post').css('marginBottom'));
    //        var container = $('#posts');
    //        container.masonry({
    //            gutter: gutter,
    //            itemSelector: '.post',
    //            columnWidth: '.post'
    //        });
    //        $(window).bind('resize', function () {
    //            if (!$('#posts').parent().hasClass('container')) {
    //                post_width = $('.post').width() + gutter;
    //                $('#posts, body > #grid').css('width', 'auto');
    //                posts_per_row = $('#posts').innerWidth() / post_width;
    //                floor_posts_width = (Math.floor(posts_per_row) * post_width) - gutter;
    //                ceil_posts_width = (Math.ceil(posts_per_row) * post_width) - gutter;
    //                posts_width = (ceil_posts_width > $('#posts').innerWidth()) ? floor_posts_width : ceil_posts_width;
    //                if (posts_width == $('.post').width()) {
    //                    posts_width = '100%';
    //                }
    //                $('#posts, #grid').css('width', posts_width);
    //                $('#grid').css({'margin': '0 auto'});
    //            }
    //        }).trigger('resize');
    //    });");
    ?>
    <?php
    //$this->registerJs(
    //    '$(document).ready(function(){
    //        $("#distance").change(function(){
    //            var e = document.getElementById("distance");
    //            var e1 = document.getElementById("category_id");
    //            var strSel =  e.options[e.selectedIndex].value;
    //            var strSel1 =  e1.options[e1.selectedIndex].value;
    //            if(strSel1 !=""){
    //                window.location.href="' . Yii::$app->urlManager->createUrl('/nearby-places/?distance=" + strSel + "&category_id=') . '" + strSel1;
    //            }
    //            else{
    //                alert("Category is not selected!")
    //            }
    //        });
    //    });');
    ?>
    <script async defer src="//assets.pinterest.com/js/pinit.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>


    <!-- Start of LiveChat (www.livechatinc.com) code -->
<!--    <script type="text/javascript">-->
<!--        window.__lc = window.__lc || {};-->
<!--        window.__lc.license = 8511488;-->
<!--        (function() {-->
<!--            var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;-->
<!--            lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';-->
<!--            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);-->
<!--        })();-->
<!--    </script>-->
    <!-- End of LiveChat code -->


    <!-- Quick Sprout: Grow your traffic -->
    <script>
        (function(e,t,n,c,r){c=e.createElement(t),c.async=1,c.src=n,
            r=e.getElementsByTagName(t)[0],r.parentNode.insertBefore(c,r)})
        (document,"script","https://cdn.quicksprout.com/qs.js");
    </script>
    <!-- End Quick Sprout -->

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
