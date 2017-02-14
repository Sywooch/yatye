<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "working_hours".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $day
 * @property string $opening_time
 * @property string $closing_time
 * @property string $closed
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Place $place
 */
class WorkingHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'working_hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'day', 'created_at'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['opening_time', 'closing_time', 'created_at', 'updated_at'], 'safe'],
            [['closed'], 'string'],
            [['day'], 'string', 'max' => 20],
            [['place_id', 'day'], 'unique', 'targetAttribute' => ['place_id', 'day'], 'message' => 'The combination of Place ID and Day has already been taken.'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'day' => 'Day',
            'opening_time' => 'Opening Time',
            'closing_time' => 'Closing Time',
            'closed' => 'Closed',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }
}
