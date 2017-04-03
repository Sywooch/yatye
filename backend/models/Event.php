<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 16:49
 */

namespace backend\models;

use backend\helpers\Helpers;
use common\helpers\RecordHelpers;
use common\helpers\ValueHelpers;
use dektrium\user\helpers\Timezone;
use frontend\models\UserProfile;
use Yii;
use common\models\Event as BaseEvent;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use \DateTimeZone;
use \DateTime;
use yii\helpers\Url;

class Event extends BaseEvent
{
    public $image_file;
    public $date;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'start_date', 'end_date'], 'required'],
            [['description'], 'string'],
            [['start_date', 'end_date', 'start_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
            [['profile_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'address', 'banner', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
            [['image_file'], 'required', 'on' => 'create'],
            [['image_file'], 'safe'],
            [['image_file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 50, 'maxSize' => 1024 * 1024],
        ];
    }


    public function getPath()
    {
        return Yii::$app->params['frontend_alias'] . Yii::$app->params['event'];
    }

    public function getThumbnailPath()
    {
        return Yii::$app->params['frontend_alias'] . Yii::$app->params['thumbnails'];
    }

    public function getParameters()
    {
        $status = Helpers::getStatus();
        $profile_types = Helpers::getProfileType();

        $contact_types = Helpers::getContactTypes();
        $contacts = [new EventContact()];
        $contactDataProvider = new ActiveDataProvider([
            'query' => EventContact::find()->where(['event_id' => $this->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Socials*/
        $social_types = Helpers::getSocialTypes();
        $socials = [new EventSocialMedia()];
        $socialDataProvider = new ActiveDataProvider([
            'query' => EventSocialMedia::find()->where(['event_id' => $this->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Tags*/
        $event_has_tags = new EventHasTags();
        $tags = EventHasTags::getNotTags($this->id);
        $tagDataProvider = new ActiveDataProvider([
            'query' => $this->getEventTags(),
            'sort' => [
                'attributes' => ['name'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*User*/
        $user_event = new UserEvent();
        $users = UserEvent::getUsers($this->id);
        $userDataProvider = new ActiveDataProvider([
            'query' => $this->getUsers(),
            'sort' => [
                'attributes' => ['email'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return [
            'model' => $this,
            'status' => $status,
            'profile_types' => $profile_types,

            /*Contacts*/
            'contactDataProvider' => $contactDataProvider,
            'contact_types' => $contact_types,
            'contacts' => $contacts,

            /*Socials*/
            'socialDataProvider' => $socialDataProvider,
            'social_types' => $social_types,
            'socials' => $socials,

            /*Tags*/
            'tagDataProvider' => $tagDataProvider,
            'event_has_tags' => $event_has_tags,
            'tags' => $tags,

            /*User*/
            'userDataProvider' => $userDataProvider,
            'user_event' => $user_event,
            'users' => $users,
        ];
    }

    public function getDate()
    {
        $today = strtotime(date("Y-m-d"));
        $_date = strtotime($this->start_date);

        $date_diff = $_date - $today;
        $difference = floor($date_diff / (60 * 60 * 24));
        if ($difference == 0) {
            $date = Yii::t('app', 'Today');
        } else if ($difference == 1) {
            $date = Yii::t('app', 'Tomorrow');
        } else if ($difference <= 7) {
            $date = date('l', $_date);
        } else {
            $date = date('D d M, Y', $_date);
        }

        return $date;
    }

    public function getBanner()
    {
        return ($this->banner != null) ? Yii::$app->params['event_images'] . $this->banner : Yii::$app->params['pragmaticmates-logo-jpg'];
    }

    public function getEventHasTags()
    {
        return (new Query())
            ->select('DISTINCT `event_has_tags`.`event_tag_id`')
            ->from('`event_tags`, `event_has_tags`')
            ->where('`event_tags`.`id` = `event_has_tags`.`event_tag_id`')
            ->andWhere('`event_has_tags`.`event_id` = ' . $this->id)
            ->all();
    }

    public function getEventTagIds()
    {
        $event_tag_ids = array();
        $event_has_tags = $this->getEventHasTags();

        foreach ($event_has_tags as $event_has_tag) {
            $event_tag_ids[] = $event_has_tag['event_tag_id'];
        }
        return $event_tag_ids;
    }

    public function getEventTags()
    {
        $event_tag_ids = $this->getEventTagIds();
        return EventTags::find()
            ->where(['in', 'id', $event_tag_ids])
            ->andWhere(['status' => Yii::$app->params['active']]);
    }

    public function getContacts()
    {
        return EventContact::find()
            ->where(['event_id' => $this->id, 'status' => Yii::$app->params['active']])
            ->orderBy('type')
            ->all();
    }

    public function getSocials()
    {
        return EventSocialMedia::findAll(['event_id' => $this->id]);
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }

    public function getEventUsers()
    {
        return (new Query())
            ->select('DISTINCT `user_event`.`user_id`')
            ->from('`user`, `user_event`')
            ->where('`user`.`id` = `user_event`.`user_id`')
            ->andWhere('`user_event`.`event_id` = ' . $this->id)
            ->all();
    }

    public function getUserIds()
    {
        $user_ids = array();
        $user_events = $this->getEventUsers();

        foreach ($user_events as $user_event) {
            $user_ids[] = $user_event['user_id'];
        }
        return $user_ids;
    }

    public function getUsers()
    {
        $user_ids = $this->getUserIds();
        return User::find()->where(['in', 'id', $user_ids]);
    }

    public function checkDateTime()
    {
        $current_date_time = new DateTime('now', new DateTimeZone('Africa/Kigali'));
        $end_date_time = new DateTime($this->end_date . ' ' . $this->end_time);

        $current_time = $current_date_time->format('Y-m-d H:i');
        $end_time = $end_date_time->format('Y-m-d H:i');

        Yii::warning('current_time: ' . $current_time);
        Yii::warning('end_time: ' . $end_time);

        return ($end_time >= $current_time) ? true : false;
    }

    public function getEventUrl()
    {
        return Url::to(['/upcoming-event/' . $this->slug]);
    }

}