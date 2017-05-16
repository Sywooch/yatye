<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use backend\models\post\Post;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;

class PostDetailsController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Post::findOne(['slug' => $slug]); //, 'status' => Yii::$app->params['publish']

        if (!is_null($model)) {
            $title = $model->title;
            $description = $model->introduction;
            $image = Yii::$app->params['post_images'] . $model->image;
            $url = 'http://rwandaguide.info/post-details/' . $model->slug;
            MetaTagHelpers::registerMetaTag($title, $description, $image, $url);

            return $this->render('index', [
                'model' => $model,
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
