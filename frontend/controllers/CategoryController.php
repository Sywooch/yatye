<?php

namespace frontend\controllers;

use backend\models\Ads;
use backend\models\Place;
use backend\models\Post;
use Yii;
use backend\models\Category;
use common\components\BaseController;

class CategoryController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Category::findOne(['slug' => $slug]);

        if (!is_null($model)) {

            $premium_places = $model->getPremiumList()->all();
            $basic_places = $model->getBasicList()->all();
            $free_places = $model->getFreeList()->all();
            $services = $model->getServices();
            $get_most_viewed = $model->getMostViewed();
            $recent_added_places = Place::getRecentAddedPlaces();
            $articles = Post::getPostsByType(1);
            $news = Post::getPostsByType(3);
            $ads = Ads::getAds();

            return $this->render('index', [
                'model' => $model,
                'premium_places' => $premium_places,
                'basic_places' => $basic_places,
                'free_places' => $free_places,
                'services' => $services,
                'recent_added_places' => $recent_added_places,
                'get_most_viewed' => $get_most_viewed,
                'articles' => $articles,
                'news' => $news,
                'ads' => $ads,

            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
