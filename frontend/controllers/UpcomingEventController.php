<?php

namespace frontend\controllers;

use Yii;
use backend\models\Event;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;

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
            $event_tags = $model->getEventTags()->all();

            return $this->render('index', [
                'model' => $model,
                'contacts' => $contacts,
                'socials' => $socials,
                'event_tags' => $event_tags,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
