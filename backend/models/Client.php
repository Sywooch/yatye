<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/5/17
 * Time: 8:47 PM
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Client as BaseClient;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Client extends BaseClient
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
            [['name', 'tin'], 'required'],
            [['type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'tin', 'code', 'address', 'email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['tin'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
            [['code'], 'default', 'value' => 'code'],
        ];
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