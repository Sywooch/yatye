<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "views_list".
 *
 * @property integer $views_id
 * @property integer $view
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
            [['views_id', 'view'], 'integer'],
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
            'views_id' => 'Views ID',
            'view' => 'View',
            'ip_address' => 'Ip Address',
            'created_at' => 'Created At',
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
