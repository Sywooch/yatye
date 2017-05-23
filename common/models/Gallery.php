<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $name
 * @property string $title
 * @property string $caption
 * @property string $path
 * @property string $logo
 * @property string $created_at
 * @property string $expire_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $service_id
 * @property integer $updated_by
 *
 * @property Place $place
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'created_at', 'status', 'created_by', 'updated_by'], 'required'],
            [['place_id', 'status', 'created_by', 'service_id', 'updated_by'], 'integer'],
            [['logo'], 'string'],
            [['created_at', 'expire_at', 'updated_at'], 'safe'],
            [['name', 'title', 'caption'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 500],
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
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'caption' => Yii::t('app', 'Caption'),
            'path' => Yii::t('app', 'Path'),
            'logo' => Yii::t('app', 'Logo'),
            'created_at' => Yii::t('app', 'Created At'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'service_id' => Yii::t('app', 'Service ID'),
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
