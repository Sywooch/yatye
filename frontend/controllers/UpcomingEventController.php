<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use backend\models\Event;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class UpcomingEventController extends BaseController
{
    public function actionIndex()
    {
        $upcoming_events = DataHelpers::getUpcomingEvents();

        Yii::warning('upcoming_events : ' . print_r($upcoming_events, true));

        $query = Event::find()
            ->where(new Expression('TIMESTAMP(`end_date`,`end_time`) >= CURRENT_TIMESTAMP'))
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('`start_date`'));

        $dataProvider = new ActiveDataProvider([
            'query' =>$query,
        ]);

        return $this->render('events', [
            'dataProvider' => $dataProvider,
            'upcoming_events' => $upcoming_events
        ]);
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
