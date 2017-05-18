<?php

namespace frontend\controllers;

use backend\controllers\PostController;
use common\helpers\DataHelpers;
use Yii;
use backend\models\post\Post;
use common\helpers\MetaTagHelpers;

class PostPreviewController extends PostController
{
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $post_category= $model->getPostCategory();

        return $this->render('index', [
            'model' => $model,
            'post_category' => $post_category,
        ]);
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

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $post_category= $model->getPostCategory();

        return $this->render('index', [
            'model' => $model,
            'post_category' => $post_category,
        ]);
    }
}
