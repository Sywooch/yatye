<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 2/14/17
 * Time: 3:55 PM
 */

namespace backend\models;

use Yii;
use common\models\UserAds as BaseUserAds;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class UserAds extends BaseUserAds
{
    public function rules()
    {
        return [
            [['user_id', 'ads_id', 'status', 'created_by', 'updated_by'], 'required'],
            [['user_id', 'ads_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
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
        ];
    }
}