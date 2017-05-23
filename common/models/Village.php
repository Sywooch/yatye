<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "village".
 *
 * @property integer $id
 * @property integer $provinve_id
 * @property integer $district_id
 * @property integer $sector_id
 * @property integer $cell_id
 * @property string $village_name
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provinve_id', 'district_id', 'sector_id', 'cell_id', 'village_name'], 'required'],
            [['provinve_id', 'district_id', 'sector_id', 'cell_id'], 'integer'],
            [['village_name'], 'string', 'max' => 255],
            [['provinve_id', 'district_id', 'sector_id', 'cell_id', 'village_name'], 'unique', 'targetAttribute' => ['provinve_id', 'district_id', 'sector_id', 'cell_id', 'village_name'], 'message' => 'The combination of Provinve ID, District ID, Sector ID, Cell ID and Village Name has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provinve_id' => 'Provinve ID',
            'district_id' => 'District ID',
            'sector_id' => 'Sector ID',
            'cell_id' => 'Cell ID',
            'village_name' => 'Village Name',
        ];
    }
}
