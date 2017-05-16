<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\post\PostCategory;
use common\components\BaseController;

class PostCategoryController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = PostCategory::find()->where((['slug' => $slug, 'status' => Yii::$app->params['active']]))->one();

        if ($model) {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getPosts(),

            ]);

            return $this->render('index', [
                'model' => $model,
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
