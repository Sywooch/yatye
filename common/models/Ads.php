<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $banner
 * @property string $caption
 * @property string $start_at
 * @property string $end_at
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
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
            [['title', 'slug', 'banner', 'type', 'created_at', 'status', 'created_by', 'updated_by'], 'required'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 75],
            [['banner'], 'string', 'max' => 255],
            [['caption'], 'string', 'max' => 125],
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
            'slug' => Yii::t('app', 'Slug'),
            'banner' => Yii::t('app', 'Banner'),
            'caption' => Yii::t('app', 'Caption'),
            'start_at' => Yii::t('app', 'Start At'),
            'end_at' => Yii::t('app', 'End At'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
