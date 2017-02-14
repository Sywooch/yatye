<?php

namespace frontend\controllers;

use backend\models\Post;
use common\components\BaseController;
use Yii;

class PostDetailsController extends BaseController
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

            Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => [$model->title, $model->getPostTypeName(), $model->getPostCategoryName(), ],]);
            Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->introduction]);

            Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://rwandaguide.info/post-details/' . $model->slug]);
            Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
            Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $model->title]);
            Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->params['post_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['property' => 'fb:app_id', 'content' => '1569960559930538']);

            Yii::$app->view->registerMetaTag(['itemprop' => 'description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'image', 'content' => Yii::$app->params['post_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'name', 'content' => $model->title]);

            Yii::$app->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:site', 'content' => '@rwandaguide_']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:creator', 'content' => '@rwandaguide_']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:title', 'content' => $model->title]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:alt', 'content' => $model->title]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:src', 'content' => Yii::$app->params['post_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:domain', 'content' => 'rwandaguide.info']);

            return $this->render('index', [
                'model' => $model,
                'post_category' => $post_category,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
