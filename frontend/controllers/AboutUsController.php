<?php

namespace frontend\controllers;

use Yii;
use backend\models\AboutUs;
use yii\data\ActiveDataProvider;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;

class AboutUsController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = AboutUs::findOne(['slug' => $slug, 'status' => Yii::$app->params['active']]);
        $about_us_posts = AboutUs::getAboutUsPosts();

        if (!is_null($model)) {
            $title = $model->title;
            $description = $model->title;
            $image = Yii::$app->params['post_images'] . $model->image;
            $url = 'http://rwandaguide.info/about-us/' . $model->slug;
            MetaTagHelpers::registerMetaTag($title, $description, $image, $url);

            return $this->render('index', [
                'model' => $model,
                'about_us_posts' => $about_us_posts,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
