<?php

namespace frontend\controllers;

use backend\models\Event;
use common\components\BaseController;

use Yii;

class UpcomingEventController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Event::findOne(['slug' => $slug]);


        if (!is_null($model)) {

            Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => [$model->name],]);
            Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $model->description]);

            Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'http://rwandaguide.info/upcoming-event/' . $model->slug]);
            Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
            Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $model->name]);
            Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $model->description]);
            Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => Yii::$app->params['event_images'] . $model->banner]);
            Yii::$app->view->registerMetaTag(['property' => 'fb:app_id', 'content' => '1569960559930538']);

            Yii::$app->view->registerMetaTag(['itemprop' => 'description', 'content' => $model->description]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'image', 'content' => Yii::$app->params['event_images'] . $model->banner]);
            Yii::$app->view->registerMetaTag(['itemprop' => 'name', 'content' => $model->banner]);

            Yii::$app->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:site', 'content' => '@rwandaguide_']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:creator', 'content' => '@rwandaguide_']);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:title', 'content' => $model->name]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:alt', 'content' => $model->name]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:description', 'content' => $model->description]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:image:src', 'content' => Yii::$app->params['event_images'] . $model->banner]);
            Yii::$app->view->registerMetaTag(['name' => 'twitter:domain', 'content' => 'rwandaguide.info']);


            $contacts = $model->getContacts();
            $socials = $model->getSocials();
            $tags = $model->getTags();

            $time = [
                'start_date'=>date('M d, Y', strtotime($model->start_at)),
                'start_time'=>date('H:i', strtotime($model->start_at)),
                'end_date'=>date('M d, Y', strtotime($model->end_at)),
                'end_time'=>date('H:i', strtotime($model->end_at)),
            ];

            return $this->render('index', [
                'model' => $model,
                'contacts' => $contacts,
                'socials' => $socials,
                'tags' => $tags,
                'time' => $time,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
