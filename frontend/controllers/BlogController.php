<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 10:46
 */

namespace frontend\controllers;

use frontend\models\BlogReview;
use Yii;
use backend\models\Blog;
use common\components\BaseController;
use yii\data\Pagination;

class BlogController extends BaseController
{
    public function actionIndex()
    {
        $get_blogs = Blog::find()->where(['status'=>Yii::$app->params['publish']]);
        $count = $get_blogs->count();
        $pagination = new Pagination([
            'defaultPageSize' => 20,
            'totalCount' => $count,
        ]);

        $blogs = $get_blogs
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'blogs' => $blogs,
            'pagination' => $pagination,
        ]);
    }

    public function actionSlug($slug)
    {
        $model = Blog::findOne(['slug' => $slug]);

        if (!is_null($model)) {

            Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => [$model->title ],]);
            Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->introduction]);

            Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://rwandaguide.info/post-details/' . $model->slug]);
            Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
            Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => 'blog - ' . $model->title]);
            Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->params['blog_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['property' => 'fb:app_id', 'content' => '1569960559930538']);

            Yii::$app->view->registerMetaTag(['itemprop' => 'description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'image', 'content' => Yii::$app->params['blog_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'name', 'content' => 'blog - ' . $model->title]);

            Yii::$app->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:site', 'content' => '@rwandaguide2015']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:creator', 'content' => '@rwandaguide2015']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:title', 'content' => 'blog - ' . $model->title]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:alt', 'content' => 'blog - ' . $model->title]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:description', 'content' => $model->introduction]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:src', 'content' => Yii::$app->params['blog_images'] . $model->image]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:domain', 'content' => 'rwandaguide.info']);

            $review = new BlogReview();

            $query = BlogReview::find()->where(['blog_id' => $model->id]);
            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $comments = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('view', [
                'model' => $model,
                'review' => $review,
                'comments' => $comments,
            ]);

        } else {
            return $this->redirect(Yii::$app->request->baseUrl . '/blog');
        }
    }

    public function actionComment()
    {

        $id = Yii::$app->request->get('id');
        $blog = Blog::findOne(['id' => $id]);
        $model = new BlogReview();

        if ($model->load(Yii::$app->request->post())) {
            $model->blog_id = $id;
            $model->status = Yii::$app->params['active'];
            $model->ip_address = Yii::$app->request->getUserIP();
            $model->save(0);

            Yii::$app->session->setFlash('success', 'Thanks for commenting!');
            return $this->redirect(Yii::$app->request->baseUrl . '/blog/' . $blog->slug);
        } else {
            Yii::$app->session->setFlash('fail', 'There was an error while submitting your comment!');
            return $this->redirect(Yii::$app->request->baseUrl . '/blog/' . $blog->slug);
        }
    }

}