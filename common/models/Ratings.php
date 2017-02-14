<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property integer $id
 * @property integer $place_id
 * @property double $ratings
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip
 * @property integer $status
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
            [['place_id', 'ratings', 'created_at', 'ip'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['ratings'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip'], 'string', 'max' => 125],
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
            'ratings' => 'Ratings',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip' => 'Ip',
            'status' => 'Status',
        ];
    }
}
