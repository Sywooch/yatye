<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/5/17
 * Time: 8:55 PM
 */

namespace backend\models;

use common\helpers\RecordHelpers;
use common\helpers\ValueHelpers;
use frontend\models\UserProfile;
use Yii;
use common\models\Invoice as BaseInvoice;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Invoice extends BaseInvoice
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
            [['client_id'], 'required'],
            [['client_id', 'vat', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['status'], 'default', 'value' => Yii::$app->params['draft']],
        ];
    }

    public function saveInvoiceItems($post, $invoice_items)
    {
        Model::loadMultiple($invoice_items, Yii::$app->request->post());
        $j = 0;
        foreach ($invoice_items as $invoice_item) {

            $name = $post[$j]['name'];
            $quantity = $post[$j]['quantity'];
            $unit_cost = $post[$j]['unit_cost'];
            $total = $quantity * $unit_cost;

            $invoice_item->invoice_id = $this->id;
            $invoice_item->name = $name;
            $invoice_item->quantity = $quantity;
            $invoice_item->unit_cost = $unit_cost;
            $invoice_item->total = $total;
            $invoice_item->save();
            $j++;
        }
    }

    public function getInvoiceItems()
    {
        return InvoiceItem::findAll(['invoice_id' => $this->id]);
    }

    public function getClient()
    {
        return Client::findOne(['id' => $this->client_id])->name;
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