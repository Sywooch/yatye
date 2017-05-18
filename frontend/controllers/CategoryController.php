<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use common\helpers\RecordHelpers;
use Yii;
use backend\models\Ads;
use backend\models\post\Post;
use backend\models\place\Place;
use backend\models\place\Category;
use common\components\BaseController;
use yii\data\ActiveDataProvider;

class CategoryController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Category::findOne(['slug' => $slug]);

        if (!empty($model)) {
            $session = Yii::$app->session;
            $session->set('category_id', $model->id);

            $premium_places = $model->getPremiumList()->all();
            $basic_places = $model->getBasicList()->all();
            $free_places = $model->getFreeList()->all();
            $services = $model->getServices();
            $get_most_viewed = $model->getMostViewed();
            $recent_added_places = Place::getRecentAddedPlaces();
            $articles = Post::getPostsByType(1);
            $news = Post::getPostsByType(3);


            $premiumListDataProvider = new ActiveDataProvider([
                'query' => $model->getPremiumList()->limit(10),
            ]);

            $basicListDataProvider = new ActiveDataProvider([
                'query' => $model->getBasicList(),
                'pagination' => [
                    'pageSize' => 6,
                ],
            ]);

            $freeListDataProvider = new ActiveDataProvider([
                'query' => $model->getFreeList()->limit(16),
            ]);

            return $this->render('index', [
                'model' => $model,
                'premiumListDataProvider' => $premiumListDataProvider,
                'basicListDataProvider' => $basicListDataProvider,
                'freeListDataProvider' => $freeListDataProvider,
                'premium_places' => $premium_places,
                'basic_places' => $basic_places,
                'free_places' => $free_places,
                'services' => $services,
                'recent_added_places' => $recent_added_places,
                'get_most_viewed' => $get_most_viewed,
                'articles' => $articles,
                'news' => $news,

            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }
}
