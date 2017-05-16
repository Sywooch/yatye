<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\post\PostType;
use common\components\BaseController;

class PostTypeController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = PostType::findOne(['slug' => $slug]);

        if (!empty($model)) {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getPosts(),

            ]);

            $post_categories = $model->getPostCategories();

            return $this->render('index', [
                'model' => $model,
                'post_categories' => $post_categories,
                'dataProvider' => $dataProvider,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

    public static function accessData()
    {
        return [
            'get_ads' => DataHelpers::getAds(),
            'get_keywords' => DataHelpers::getKeywords(),
            'all_categories' => DataHelpers::getAllCategories(),
            'get_post_archives' => DataHelpers::getPostArchives(),
            'get_upcoming_events' => DataHelpers::getUpcomingEvents(),
        ];
    }
}
