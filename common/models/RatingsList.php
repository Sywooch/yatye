<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ratings_list".
 *
 * @property integer $id
 * @property integer $rating_id
 * @property integer $ratings
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 *
 * @property Ratings $rating
 */
class RatingsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ratings_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rating_id', 'ratings', 'created_at', 'ip_address'], 'required'],
            [['rating_id', 'ratings'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 255],
            [['rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ratings::className(), 'targetAttribute' => ['rating_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rating_id' => Yii::t('app', 'Rating ID'),
            'ratings' => Yii::t('app', 'Ratings'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ip_address' => Yii::t('app', 'Ip Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRating()
    {
        return $this->hasOne(Ratings::className(), ['id' => 'rating_id']);
    }
}
