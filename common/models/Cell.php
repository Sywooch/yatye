<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cell".
 *
 * @property integer $id
 * @property integer $province_id
 * @property integer $district_id
 * @property integer $sector_id
 * @property string $name
 * @property string $code
 */
class Cell extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cell';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_id', 'district_id', 'sector_id', 'name', 'code'], 'required'],
            [['province_id', 'district_id', 'sector_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 6],
            [['province_id', 'district_id', 'sector_id', 'name'], 'unique', 'targetAttribute' => ['province_id', 'district_id', 'sector_id', 'name'], 'message' => 'The combination of Province ID, District ID, Sector ID and Name has already been taken.'],
            [['code'], 'unique'],
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
            'sector_id' => 'Sector ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
