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
        $tagDataProvider = new ArrayDataProvider([
            'allModels' => $this->getTags(),
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
        $userDataProvider = new ArrayDataProvider([
            'allModels' => $this->getEventUsers(),
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


    /*#################################################################################*/

    public function getTags()
    {
        $query = new Query();

        $select = $query
            ->select('`event_tags`.`id`')
            ->addSelect('`event_tags`.`name`')
            ->addSelect('`event_tags`.`status`')
            ->addSelect('`event_has_tags`.`event_id`')
            ->from('`event_tags`, `event`, `event_has_tags`')
            ->where('`event`.`id` = `event_has_tags`.`event_id`')
            ->andWhere('`event_tags`.`id` = `event_has_tags`.`event_tag_id`')
            ->andWhere('`event`.`id` = ' . $this->id)
            ->orderBy('`event_tags`.`name`')
            ->all();

        return $select;
    }

    public function getEventUsers()
    {
        $query = new Query();

        $select = $query
            ->select('`user`.`id`')
            ->addSelect('`user`.`email`')
            ->addSelect('`user_event`.`event_id`')
            ->from('`user`, `event`, `user_event`')
            ->where('`event`.`id` = `user_event`.`event_id`')
            ->andWhere('`user`.`id` = `user_event`.`user_id`')
            ->andWhere('`event`.`id` = ' . $this->id)
            ->orderBy('`user`.`email`')
            ->all();
        return $select;
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
}