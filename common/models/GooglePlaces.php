<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "google_places".
 *
 * @property integer $id
 * @property string $name
 * @property string $google_id
 * @property string $place_id
 * @property string $reference
 * @property double $lat
 * @property double $lng
 * @property string $vicinity
 * @property string $types
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class GooglePlaces extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'google_places';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['google_id', 'place_id', 'reference', 'lat', 'lng', 'created_at', 'created_by', 'updated_by', 'status'], 'required'],
            [['lat', 'lng'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['name', 'google_id', 'place_id', 'vicinity', 'types'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 500],
            [['place_id'], 'unique'],
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
            'google_id' => Yii::t('app', 'Google ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'reference' => Yii::t('app', 'Reference'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'vicinity' => Yii::t('app', 'Vicinity'),
            'types' => Yii::t('app', 'Types'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
