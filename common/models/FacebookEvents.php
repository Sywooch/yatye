<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "facebook_events".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $name
 * @property string $city
 * @property string $country
 * @property double $latitude
 * @property double $longitude
 * @property string $start_time
 * @property string $end_time
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $description
 */
class FacebookEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facebook_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'name', 'start_time', 'end_time', 'status', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['event_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['start_time', 'end_time', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['name', 'city', 'country'], 'string', 'max' => 255],
            [['event_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'name' => Yii::t('app', 'Name'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
