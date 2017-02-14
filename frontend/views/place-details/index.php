<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::$app->name . ' - ' . $model->name;
?>
    <div class="container">
        <div class="row detail-content">
            <div class="col-sm-7">
                <div class="detail-gallery">
                    <?php if ($model->logo != null) { ?>
                        <div class="detail-gallery-preview">
                            <a href="#">
                                <img alt="<?php echo $model->name ?>"
                                     src="<?php echo Yii::$app->params['galleries'] . $model->logo ?>"
                                     style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 32px; width: 652px;'>
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="detail-gallery-preview">
                            <div class="cards-wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card"
                                             data-background-image="<?php echo Yii::$app->params['pragmaticmates-logo-jpg'] ?>">
                                            <div class="card-content">
                                                <h2><a href="#"><?php echo $model->name ?></a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if (!empty($photos)){ ?>
                    <ul class="detail-gallery-index div">
                        <?php foreach ($photos as $photo): ?>
                            <li class="detail-gallery-list-item active">
                                <a data-target="<?php echo Yii::$app->params['galleries'] . $photo->name ?>">
                                    <img src="<?php echo Yii::$app->params['tn_thumbnails'] . $photo->name ?>"
                                         alt="<?php echo $model->name ?>"
                                         style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 12px;'>
                                </a>
                            </li>
                        <?php endforeach;
                        } ?>
                    </ul>
                </div>

                <?php if (($model->profile_type == Yii::$app->params['PREMIUM'] || $model->profile_type == Yii::$app->params['BASIC']) && ( $model->latitude != null || $model->longitude != null))  : ?>
                    <!--Maps-->
                    <?php echo $this->render('_map', [
                        'model' => $model,
                    ]); ?>
                <?php endif; ?>

                <?php if ($other_places) : ?>
                    <h2>Other Places Around</h2>
                    <div class="background-white p20 div">
                        <div class="widget">
                            <div class="row">
                                <?php foreach ($other_places as $other_place): ?>
                                    <div class="col-sm-6">
                                        <div class="cards-small">
                                            <div class="card-small">
                                                <div class="card-small-image">
                                                    <a href="listing-detail.html">

                                                        <?php if ($other_place['logo'] != null) : ?>
                                                            <img style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 12px;width: 80px; height: 60px;'
                                                                 src="<?php echo Yii::$app->params['tn_thumbnails'] . $other_place['logo'] ?>"
                                                                 alt="<?php echo $other_place['name'] ?>">
                                                        <?php else : ?>
                                                            <div class="detail-logo">
                                                                <img src="<?php echo Yii::$app->params['pragmaticmates-logo-jpg'] ?>"
                                                                     style='"Helvetica Neue", Helvetica, Arial, sans-serif; color: #5d4942; font-size: 12px;width: 80px; height: 60px;'>
                                                            </div>
                                                        <?php endif; ?>
                                                    </a>
                                                </div>

                                                <div class="card-small-content">

                                                    <h3>
                                                        <a href="<?php echo Url::to(['/place-details/' . $other_place['slug']]) ?>"
                                                           target="_blank"><?php echo $other_place['name'] ?></a></h3>
                                                    <h4>
                                                        <a href="listing-detail.html"><?php echo $other_place['neighborhood'] ?>
                                                            / <?php echo $other_place['street'] ?></a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                <?php endif; ?>

                <!--Reviews-->
                <?php echo $this->render('_review_form', [
                    'model' => $model,
                    'review' => $review,
                    'comments' => $comments,
                    'pagination' => $pagination,
                ]); ?>
            </div>


            <!--Right Side-->
            <div class="col-sm-5">
                <?php echo $this->render('_right_side', [
                    'model' => $model,
                    'views' => $views,
                    'contacts' => $contacts,
                    'socials' => $socials,
                    'place_id' => $place_id,
                    'ratings' => $ratings,
                    'working_hours' => $working_hours,
                    'amenities' => $amenities,
                    'contact_form' => $contact_form,

                ]); ?>
            </div>

            <div class="col-sm-12">
                <?php if (!empty($related_places)) : ?>
                    <h2>You may also like</h2>
                    <div class="cards-simple-wrapper">
                        <div class="row">
                            <?php foreach ($related_places as $related_place): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card-simple"
                                         data-background-image="<?php echo ($related_place->logo != null) ? Yii::$app->params['thumbnails'] . $related_place->logo : Yii::$app->params['pragmaticmates-logo-jpg'] ?>">
                                        <div class="card-simple-background">
                                            <div class="card-simple-content">
                                                <h2>
                                                    <a href="<?php echo Url::to(['/place-details/' . $related_place->slug]) ?>"><?php echo $related_place->name; ?></a>
                                                </h2>
                                                <div class="card-simple-actions">
                                                    <a href="<?php echo Url::to(['/place-details/' . $related_place->slug]) ?>"
                                                       class="fa fa-eye"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?Php
$script = '$(document).ready(function(){
        $("#rateIt").hide();
        $("#rateMe").click(function(){
            $("#showAverage").hide();
            $("#rateIt").show();
        });
    })';
$this->registerJs($script);
?>