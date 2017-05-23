<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $start_at
 * @property string $end_at
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $url
 * @property integer $size
 *
 * @property UserAds[] $userAds
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'type', 'created_at', 'status', 'created_by', 'updated_by', 'size'], 'required'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'created_by', 'updated_by', 'size'], 'integer'],
            [['title'], 'string', 'max' => 75],
            [['image', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'url' => Yii::t('app', 'Url'),
            'size' => Yii::t('app', 'Size'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAds()
    {
        return $this->hasMany(UserAds::className(), ['ads_id' => 'id']);
    }
}
