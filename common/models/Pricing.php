<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pricing".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $descriptions
 * @property double $price
 * @property double $discount
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 * @property integer $status
 *
 * @property PricingHasItem[] $pricingHasItems
 * @property PricingItem[] $pricingItems
 */
class Pricing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pricing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'descriptions', 'price', 'discount', 'created_by', 'created_at', 'updated_by', 'status'], 'required'],
            [['price', 'discount'], 'number'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 20],
            [['slug', 'descriptions'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'slug' => Yii::t('app', 'Slug'),
            'descriptions' => Yii::t('app', 'Descriptions'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('app', 'Discount'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricingHasItems()
    {
        return $this->hasMany(PricingHasItem::className(), ['pricing_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricingItems()
    {
        return $this->hasMany(PricingItem::className(), ['id' => 'pricing_item_id'])->viaTable('pricing_has_item', ['pricing_id' => 'id']);
    }
}
