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
            [['place_id'], 'required'],
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
            'id' => 'ID',
            'place_id' => 'Place ID',
            'name' => 'Name',
            'title' => 'Title',
            'caption' => 'Caption',
            'path' => 'Path',
            'logo' => 'Logo',
            'created_at' => 'Created At',
            'expire_at' => 'Expire At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'created_by' => 'Created By',
            'service_id' => 'Service ID',
            'updated_by' => 'Updated By',
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
