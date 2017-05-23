<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sector".
 *
 * @property integer $id
 * @property integer $province_id
 * @property integer $district_id
 * @property string $name
 * @property string $code
 */
class Sector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'district_id', 'name', 'code'], 'required'],
            [['province_id', 'district_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            [['code'], 'string', 'max' => 10],
            [['province_id', 'district_id', 'name'], 'unique', 'targetAttribute' => ['province_id', 'district_id', 'name'], 'message' => 'The combination of Province ID, District ID and Name has already been taken.'],
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
            'district_id' => 'District ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
