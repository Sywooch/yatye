<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string $start_at
 * @property string $end_at
 * @property string $banner
 * @property integer $profile_type
 * @property double $latitude
 * @property double $longitude
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $slug
 *
 * @property EventHasTags[] $eventHasTags
 * @property EventTags[] $eventTags
 * @property UserEvent[] $userEvents
 * @property User[] $users
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'start_at', 'end_at', 'created_at', 'status', 'created_by', 'updated_by', 'slug'], 'required'],
            [['description'], 'string'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['profile_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'address', 'banner', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'address' => Yii::t('app', 'Address'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
            'banner' => Yii::t('app', 'Banner'),
            'profile_type' => Yii::t('app', 'Profile Type'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'slug' => Yii::t('app', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventHasTags()
    {
        return $this->hasMany(EventHasTags::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTags()
    {
        return $this->hasMany(EventTags::className(), ['id' => 'event_tag_id'])->viaTable('event_has_tags', ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEvents()
    {
        return $this->hasMany(UserEvent::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_event', ['event_id' => 'id']);
    }
}
