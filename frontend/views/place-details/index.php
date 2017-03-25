<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::$app->name . ' - ' . $model->name;
?>
<div class="content">

    <!--Banner-->
    <?php if ($model->profile_type == Yii::$app->params['PREMIUM'] || $model->profile_type == Yii::$app->params['BASIC']): ?>
        <?php echo $this->render('_banner', [
            'model' => $model,
        ]); ?>
    <?php endif; ?>
    <div class="row detail-content">
        <div class="col-sm-7">

            <!--Gallery-->
            <?php echo $this->render('_gallery', [
                'model' => $model,
                'photos' => $photos,
            ]); ?>
            <!--Maps-->
            <?php if (($model->profile_type == Yii::$app->params['PREMIUM'] || $model->profile_type == Yii::$app->params['BASIC'])
                && ($model->latitude != null || $model->longitude != null))  : ?>
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
                                                        <img class="img-responsive img-alt-thumbnail_tn"
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
            <?php if (!empty($related_places)) :
                echo $this->render('_related', [
                    'model' => $model,
                    'related_places' => $related_places,
                ]); endif; ?>
        </div>
    </div>
</div>