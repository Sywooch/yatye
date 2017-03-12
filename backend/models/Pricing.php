<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 02/01/2017
 * Time: 11:31
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Pricing as BasePricing;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

class Pricing extends BasePricing
{
    public function rules()
    {
        return [
            [['title', 'slug', 'descriptions', 'price', 'discount'], 'required'],
            [['price', 'discount'], 'number'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 20],
            [['slug', 'descriptions'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['draft']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    public function getPricingItems()
    {
        $query = new Query();

        $select = $query
            ->select('`pricing_item`.`id`')
            ->addSelect('`pricing_item`.`name`')
            ->addSelect('`pricing_has_item`.`descriptions`')
            ->addSelect('`pricing_has_item`.`pricing_id`')
            ->from('`pricing`, `pricing_item`, `pricing_has_item`')
            ->where('`pricing`.`id` = `pricing_has_item`.`pricing_id`')
            ->andWhere('`pricing_item`.`id` = `pricing_has_item`.`pricing_item_id`')
            ->andWhere('`pricing`.`id` = ' . $this->id)
            ->orderBy('`pricing_item`.`id`')
            ->all();

        return $select;
    }
    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }
}