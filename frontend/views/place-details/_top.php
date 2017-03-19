<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:42
 */
?>

<div class="background-white p20 div">
    <div class="row p20">
        <div class="detail-overview-hearts">
            <?php if ($views > 10): ?>
                <i class="fa fa-eye" style="color: #5d4942;"></i>
                <small><b><?php echo $views ?></b></small> <?php echo Yii::t('app', 'people viewed it') ?>
            <?php endif; ?>
        </div>
        <div class="detail-overview-rating">
            <div id="showAverage">
                <?php echo $model->getRatingStars()?>&nbsp;&nbsp;&nbsp;
                <button type="button" id="rateMe" class="btn btn-secondary btn-xs"><?php echo Yii::t('app', 'Add your rate') ?></button>
            </div>
            <div id="rateIt">
                <?php echo $this->render('_rating-form', [
                    'model' => $model,
                    'ratings' => $ratings,
                    'place_id' => $place_id,
                ]); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <ul class="share list-unstyled">
                <li>
                    <div class="fb-share-button"
                         data-href="http://rwandaguide.info/<?php echo Yii::$app->request->getUrl() ?>"
                         data-layout="button_count"></div>
                </li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="share list-unstyled">
                <li><a class="twitter-share-button" href="https://twitter.com/intent/tweet"> Twitter</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="share list-unstyled">
                <li>
                    <!--                                    <div class="g-plus" data-action="share" data-annotation="bubble"></div>-->
                    <!-- Place this tag where you want the +1 button to render. -->
                    <div class="g-plusone" data-size="medium"></div>

                    <!-- Place this tag after the last +1 button tag. -->
                    <script type="text/javascript">
                        (function () {
                            var po = document.createElement('script');
                            po.type = 'text/javascript';
                            po.async = true;
                            po.src = 'https://apis.google.com/js/platform.js';
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(po, s);
                        })();
                    </script>
                </li>
            </ul>
        </div>
        <div class="col-sm-3">
            <ul class="share list-unstyled">
                <li><a href="https://www.pinterest.com/pin/create/button/"><img
                                src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png"/></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php $this->registerJs('$(document).ready(function(){
        $("#rateIt").hide();
        $("#rateMe").click(function(){
            $("#showAverage").hide();
            $("#rateIt").show();
        });
    })'); ?>
