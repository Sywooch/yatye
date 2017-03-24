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


            return $this->render('index', [
                'model' => $model,
                'contacts' => $contacts,
                'socials' => $socials,
                'tags' => $tags,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
