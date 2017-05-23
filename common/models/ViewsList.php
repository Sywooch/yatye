<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "views_list".
 *
 * @property integer $id
 * @property integer $views_id
 * @property string $ip_address
 * @property string $created_at
 *
 * @property Views $views
 */
class ViewsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['views_id', 'ip_address'], 'required'],
            [['views_id'], 'integer'],
            [['created_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 255],
            [['views_id'], 'exist', 'skipOnError' => true, 'targetClass' => Views::className(), 'targetAttribute' => ['views_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'views_id' => Yii::t('app', 'Views ID'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasOne(Views::className(), ['id' => 'views_id']);
    }
}
