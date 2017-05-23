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
 * @property integer $created_by
 * @property integer $updated_by
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
            [['place_id', 'day', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['place_id', 'status', 'created_by', 'updated_by'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'day' => Yii::t('app', 'Day'),
            'opening_time' => Yii::t('app', 'Opening Time'),
            'closing_time' => Yii::t('app', 'Closing Time'),
            'closed' => Yii::t('app', 'Closed'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
