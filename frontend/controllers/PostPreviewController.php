<?php

namespace frontend\controllers;

use Yii;
use backend\models\post\Post;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;

class PostPreviewController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Post::findOne(['slug' => $slug]);

        if (!is_null($model)) {

            $post_category= $model->getPostCategory();

            $title = $model->title;
            $description = $model->introduction;
            $image = Yii::$app->params['post_images'] . $model->image;
            $url = 'http://rwandaguide.info/post-details/' . $model->slug;
            MetaTagHelpers::registerMetaTag($title, $description, $image, $url);

            return $this->render('index', [
                'model' => $model,
                'post_category' => $post_category,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}