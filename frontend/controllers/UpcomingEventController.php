<?php

namespace frontend\controllers;

use backend\models\Event;
use common\components\BaseController;

use common\helpers\MetaTagHelpers;
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

            $title = $model->name;
            $description = $model->description;
            $image = Yii::$app->params['event_images'] . $model->banner;
            $url = 'http://rwandaguide.info/upcoming-event/' . $model->slug;
            MetaTagHelpers::registerMetaTag($title, $description, $image, $url);

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
