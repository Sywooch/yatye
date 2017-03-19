<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filter".
 *
 * @property integer $id
 * @property string $key_word
 * @property integer $province_id
 * @property integer $district_id
 * @property integer $category_id
 * @property integer $service_id
 * @property string $ip_address
 * @property string $created_at
 * @property integer $results
 * @property integer $user_id
 */
class Filter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'district_id', 'category_id', 'service_id', 'results', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['results', 'user_id'], 'required'],
            [['key_word', 'ip_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key_word' => Yii::t('app', 'Key Word'),
            'province_id' => Yii::t('app', 'Province ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'created_at' => Yii::t('app', 'Created At'),
            'results' => Yii::t('app', 'Results'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
