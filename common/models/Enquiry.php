<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property string $ip_address
 *
 * @property Place $place
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'name', 'email', 'subject', 'message', 'created_at', 'status'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'subject', 'ip_address'], 'string', 'max' => 255],
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
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'ip_address' => Yii::t('app', 'Ip Address'),
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
