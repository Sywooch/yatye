<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $id
 * @property integer $province_id
 * @property string $name
 * @property string $code
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'name', 'code'], 'required'],
            [['province_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['code'], 'string', 'max' => 3],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
