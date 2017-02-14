<?php

namespace frontend\controllers;

use backend\models\Place;
use backend\models\Post;
use backend\models\PostCategory;
use Yii;
use backend\models\Category;
use common\models\Ads;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
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
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name, 'Rwanda', 'Kigali', 'Rwanda Guide'],
            ]);

            $premium_places = $model->getPremiumPlaces();
            $basic_places = $model->getBasicPlaces();
            $free_places = $model->getFreePlaces();
            $services = $model->getService();
            $a_places = $model->getAPlaces();
            $get_most_viewed = $model->getMostViewed();
            $recent_added_places = Place::getRecentAddedPlaces();
            $articles = Post::getPostsByType(1);
            $news = Post::getPostsByType(3);

            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name,],
            ]);
            return $this->render('index', [
                'model' => $model,
                'premium_places' => $premium_places,
                'basic_places' => $basic_places,
                'free_places' => $free_places,
                'services' => $services,
                'a_places' => $a_places,
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
