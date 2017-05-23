<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $model->name;
?>
<div class="row">
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
                && ($model->latitude != null || $model->longitude != null)
            )  : ?>
                <?php echo $this->render('_map', [
                    'model' => $model,
                ]); ?>
            <?php endif; ?>

            <!--Other Places Around-->
            <?php if (!empty($other_places)) : echo $this->render('_places_around', [
                'model' => $model,
                'dataProvider' => $nearByPlacesDataProvider,
            ]); endif; ?>

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
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <?php if (!empty($related_places)) :
        echo $this->render('_related_places', [
            'model' => $model,
            'related_places' => $related_places,
            'dataProvider' => $relatedPlacesDataProvider,
        ]); endif; ?>
</div>
