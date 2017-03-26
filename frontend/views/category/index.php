<?php
/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' - ' . $model->name;
?>

<div class="content">
    <div class="mt-80">
        <!--Premium List-->
        <?php if (!empty($premium_places)):
            echo $this->render('_premium', [
                'model' => $model,
                'premium_places' => $premium_places,
                'services' => $services,
                'recent_added_places' => $recent_added_places,
                'get_most_viewed' => $get_most_viewed,
            ]);
        endif; ?>

        <!--Advertisement Banners 840x120-->
<!--        --><?php //if (!empty($ads['840x120'])) :
//            echo $this->render('ads/ads_840_x_120', [
//                'model' => $model,
//                'ads' => $ads,
//            ]);
//        endif; ?>


        <!--Basic List-->
        <?php echo $this->render('_basic', [
            'model' => $model,
            'basic_places' => $basic_places,
        ]); ?>

        <!--Advertisement Banners 250x250-->
<!--        --><?php //echo $this->render('ads/ads_250_x_250', [
//            'model' => $model,
//        ]); ?>

        <!--Articles-->
        <?php echo $this->render('_articles', [
            'model' => $model,
            'articles' => $articles,
            'news' => $news,
        ]); ?>

        <!--Advertisement Banners 180x150-->
<!--        --><?php //echo $this->render('ads/ads_180_x_150', [
//            'model' => $model,
//        ]); ?>

        <!--Free List-->
        <?php if (!empty($free_places)):
            echo $this->render('_free', [
                'model' => $model,
                'free_places' => $free_places,
            ]);
        endif; ?>
    </div>
</div>

