<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice_item".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property string $name
 * @property string $description
 * @property integer $quantity
 * @property string $unit_cost
 * @property string $total
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 */
class InvoiceItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'name', 'quantity', 'unit_cost', 'total', 'created_at', 'created_by', 'updated_by', 'status'], 'required'],
            [['invoice_id', 'quantity', 'created_by', 'updated_by', 'status'], 'integer'],
            [['unit_cost', 'total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'invoice_id' => Yii::t('app', 'Invoice ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit_cost' => Yii::t('app', 'Unit Cost'),
            'total' => Yii::t('app', 'Total'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
