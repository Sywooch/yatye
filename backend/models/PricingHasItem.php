<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/01/2017
 * Time: 21:22
 */

namespace backend\models;

use Yii;
use common\models\PricingHasItem as BasePricingHasItem;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class PricingHasItem extends BasePricingHasItem
{
    public function rules()
    {
        return [
            [['pricing_id', 'pricing_item_id'], 'required'],
            [['pricing_id', 'pricing_item_id'], 'integer'],
            [['created_at'], 'safe'],
            [['descriptions'], 'string', 'max' => 50],
            [['pricing_id', 'pricing_item_id'], 'unique', 'targetAttribute' => ['pricing_id', 'pricing_item_id'], 'message' => 'The combination of Pricing and Pricing Item has already been taken.'],

        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getNotPricingItems($pricing_id)
    {

        $subQuery = (new Query())
            ->select('DISTINCT `pricing_item`.`id`')
            ->from('`pricing_has_item`, `pricing_item`')
            ->where('`pricing_has_item`.`pricing_id`=' . $pricing_id)
            ->andWhere('`pricing_has_item`.`pricing_item_id` = `pricing_item`.`id`')
            ->andWhere('`pricing_item`.`status` =' . Yii::$app->params['active'])
            ->all();

        return ArrayHelper::map(PricingItem::find()->where(['not in', 'id' , $subQuery])
            ->andWhere(['status'=>Yii::$app->params['active']])
            ->all(), 'id', 'name');
    }
}