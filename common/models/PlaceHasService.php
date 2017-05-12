<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "place_has_service".
 *
 * @property integer $place_id
 * @property integer $service_id
 * @property string $created_at
 * @property integer $status
 *
 * @property Place $place
 */
class PlaceHasService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_has_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'service_id', 'created_at'], 'required'],
            [['place_id', 'service_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['place_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'place_id' => 'Place ID',
            'service_id' => 'Service ID',
            'created_at' => 'Created At',
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
