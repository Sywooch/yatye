<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "export".
 *
 * @property string $name
 * @property string $emails
 * @property string $phones
 * @property string $webstes
 * @property string $province
 * @property string $district
 * @property string $sector
 * @property string $cell
 * @property string $village
 * @property string $neighborhood
 * @property string $street
 */
class Export extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'export';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'emails', 'phones', 'webstes', 'province', 'district', 'sector', 'cell', 'village', 'neighborhood', 'street'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'emails' => Yii::t('app', 'Emails'),
            'phones' => Yii::t('app', 'Phones'),
            'webstes' => Yii::t('app', 'Webstes'),
            'province' => Yii::t('app', 'Province'),
            'district' => Yii::t('app', 'District'),
            'sector' => Yii::t('app', 'Sector'),
            'cell' => Yii::t('app', 'Cell'),
            'village' => Yii::t('app', 'Village'),
            'neighborhood' => Yii::t('app', 'Neighborhood'),
            'street' => Yii::t('app', 'Street'),
        ];
    }
}
