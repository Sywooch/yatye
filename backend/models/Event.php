<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 16:49
 */

namespace backend\models;

use common\helpers\RecordHelpers;
use frontend\models\UserProfile;
use Yii;
use common\models\Event as BaseEvent;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

class Event extends BaseEvent
{
    public $image_file;

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
            [['image_file'], 'safe'],
            [['image_file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 50, 'maxSize' => 1024 * 1024],
            [['name', 'start_at', 'end_at'], 'required'],
            [['description'], 'string'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['profile_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'address', 'banner', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
        ];
    }

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
        return EventContact::find()->where(['event_id' => $this->id, 'status' => Yii::$app->params['active']])->orderBy('type')->all();
    }

    public function getSocials()
    {
        return EventSocialMedia::findAll(['event_id' => $this->id]);
    }

    public function getUser()
    {
        if ($already_exists = RecordHelpers::userHas('user_profile')) {
            $user_profile = UserProfile::findOne(['user_id' => $this->created_by]);
            return $user_profile->first_name . ' ' . $user_profile->last_name;
        }
        else{
            $user = User::findOne(['id' => $this->created_by]);
            return $user->username;
        }

    }
}