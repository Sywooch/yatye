<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property integer $id
 * @property integer $place_id
 * @property integer $average
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Place $place
 * @property RatingsList[] $ratingsLists
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'average', 'created_at', 'status'], 'required'],
            [['place_id', 'average', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'average' => Yii::t('app', 'Average'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatingsLists()
    {
        return $this->hasMany(RatingsList::className(), ['rating_id' => 'id']);
    }
}
