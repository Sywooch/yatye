<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

//\bedezign\yii2\audit\web\JSLoggingAsset::register($this);
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
    <meta name="title" content="<?= Html::encode($this->title) ?>"/>
    <meta name="classification"
          content="This website will help you find more information about a place you would like to visit. This website also helps businesses reach out to potential clients about their services.">
    <meta name="geography" content="Rwanda Kigali">
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

    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

    <link href="http://fonts.googleapis.com/css?family=Nunito:300,400,700" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/png" href="<?= Yii::$app->params['icon_96']; ?>"/>
    <link rel="alternate" href="http://rwandaguide.info/" hreflang="en"/>
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
    <!-- End Facebook Pixel Code -->
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

    <?php $this->registerCss(".pre-load{display: none;} ") ?>




<!--    <script>-->
<!--        !function(){function c(){var a=b.createElement("script");-->
<!--            a.src='https://resend.io/widget.js',a.async=!0,a.onload=function(){__init('RAd1U2MEhUWFNuNGd5ZUE9PQ==')},-->
<!--                b.getElementsByTagName("head")[0].appendChild(a)}var a=window,b=document;-->
<!--            a.attachEvent?a.attachEvent("onload",c):a.addEventListener("load",c,!1)}();-->
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

    <?php echo $this->render('@app/views/layouts/_header') ?>
    <?php echo $this->render('@app/views/layouts/_messages') ?>
    <div class="main">
        <div class="main-inner" style="padding-top: 30px;">
            <div class="content">
                <?= $content ?>
            </div>
        </div>
    </div>
    <?php echo $this->render('@app/views/layouts/_footer') ?>
</div>
<?php
$this->registerJs("$(window).load(function () {
        $('.pre-load').fadeIn(5000);
    });");
?>
<script
    src="http://maps.googleapis.com/maps/api/js?libraries=weather,geometry,visualization,places,drawing&amp;sensor=false"
    type="text/javascript"></script>
<script>
    window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));
</script>
<script>
    window.___gcfg = {
        lang: 'en-US',
        parsetags: 'onload'
    };
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>


<?php $this->endBody() ?>
<script>
    $(document).ready(function () {
        $(".pager li").removeClass("next");
    });
</script>

<!--Start of Tawk.to Script-->
<!--<script type="text/javascript">-->
<!--    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
<!--    (function(){-->
<!--        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
<!--        s1.async=true;-->
<!--        s1.src='https://embed.tawk.to/580cd9d2d0f23f0cd8dbf24a/default';-->
<!--        s1.charset='UTF-8';-->
<!--        s1.setAttribute('crossorigin','*');-->
<!--        s0.parentNode.insertBefore(s1,s0);-->
<!--    })();-->
<!--</script>-->
<!--End of Tawk.to Script-->

<!-- Start of LiveChat (www.livechatinc.com) code -->
<!--<script type="text/javascript">-->
<!--    window.__lc = window.__lc || {};-->
<!--    window.__lc.license = 8511488;-->
<!--    (function() {-->
<!--        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;-->
<!--        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';-->
<!--        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);-->
<!--    })();-->
<!--</script>-->
<!-- End of LiveChat code -->

<!-- Quick Sprout: Grow your traffic -->
<script>
    (function(e,t,n,c,r){c=e.createElement(t),c.async=1,c.src=n,
        r=e.getElementsByTagName(t)[0],r.parentNode.insertBefore(c,r)})
    (document,"script","https://cdn.quicksprout.com/qs.js");
</script>
<!-- End Quick Sprout -->


</body>
</html>
<?php $this->endPage() ?>
