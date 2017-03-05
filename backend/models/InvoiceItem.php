<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/5/17
 * Time: 8:59 PM
 */

namespace backend\models;

use Yii;
use common\models\InvoiceItem as BaseInvoiceItem;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class InvoiceItem extends BaseInvoiceItem
{
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
        ];
    }

    public function rules()
    {
        return [
            [['invoice_id', 'name', 'quantity', 'unit_cost', 'total'], 'required'],
            [['invoice_id', 'quantity', 'created_by', 'updated_by', 'status'], 'integer'],
            [['unit_cost', 'total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 125],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
        ];
    }
}