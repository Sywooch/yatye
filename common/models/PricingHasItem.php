<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pricing_has_item".
 *
 * @property integer $pricing_id
 * @property integer $pricing_item_id
 * @property string $created_at
 * @property string $descriptions
 *
 * @property Pricing $pricing
 * @property PricingItem $pricingItem
 */
class PricingHasItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricing_has_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pricing_id', 'pricing_item_id', 'created_at', 'descriptions'], 'required'],
            [['pricing_id', 'pricing_item_id'], 'integer'],
            [['created_at'], 'safe'],
            [['descriptions'], 'string', 'max' => 50],
            [['pricing_id', 'pricing_item_id'], 'unique', 'targetAttribute' => ['pricing_id', 'pricing_item_id'], 'message' => 'The combination of Pricing ID and Pricing Item ID has already been taken.'],
            [['pricing_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pricing::className(), 'targetAttribute' => ['pricing_id' => 'id']],
            [['pricing_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PricingItem::className(), 'targetAttribute' => ['pricing_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pricing_id' => Yii::t('app', 'Pricing ID'),
            'pricing_item_id' => Yii::t('app', 'Pricing Item ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'descriptions' => Yii::t('app', 'Descriptions'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricing()
    {
        return $this->hasOne(Pricing::className(), ['id' => 'pricing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricingItem()
    {
        return $this->hasOne(PricingItem::className(), ['id' => 'pricing_item_id']);
    }
}
