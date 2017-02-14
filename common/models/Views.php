<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "views".
 *
 * @property integer $id
 * @property integer $place_id
 * @property double $views
 * @property string $ip
 * @property integer $status
 *
 * @property Place $place
 */
class Views extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'views', 'ip'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['views'], 'number'],
            [['ip'], 'string', 'max' => 125],
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
            'id' => 'ID',
            'place_id' => 'Place ID',
            'views' => 'Views',
            'ip' => 'Ip',
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
