<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pricing_item".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 *
 * @property PricingHasItem[] $pricingHasItems
 * @property Pricing[] $pricings
 */
class PricingItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricing_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by', 'updated_by', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricingHasItems()
    {
        return $this->hasMany(PricingHasItem::className(), ['pricing_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricings()
    {
        return $this->hasMany(Pricing::className(), ['id' => 'pricing_id'])->viaTable('pricing_has_item', ['pricing_item_id' => 'id']);
    }
}
