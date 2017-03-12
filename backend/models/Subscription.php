<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/12/2016
 * Time: 15:27
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Subscription as BaseSubscription;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Subscription extends BaseSubscription
{
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['verified', 'status', 'place', 'visitor', 'user', 'place_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'unsubscribe_place', 'unsubscribe_visitor', 'unsubscribe_user'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['verified', 'status', 'place', 'visitor', 'user'], 'default', 'value' => 0],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function saveUserToSubscription($email)
    {
        $exist_subscription = Subscription::findOne(['email' => $email]);

        if ($exist_subscription) {
            $exist_subscription->user = 1;
            $exist_subscription->save();
        } else {
            $subscription = new Subscription();
            $subscription->email = $email;
            $subscription->user = 1;
            $subscription->save();
        }
    }

    public static function savePlaceToSubscription($email, $place_id)
    {
        $exist_subscription = Subscription::findOne(['email' => $email]);

        if ($exist_subscription) {
            $exist_subscription->place = 1;
            $exist_subscription->place_id = $place_id;
            $exist_subscription->status = Yii::$app->params['inactive'];
            $exist_subscription->save();
        } else {
            $subscription = new Subscription();
            $subscription->email = $email;
            $subscription->place = 1;
            $subscription->place_id = $place_id;
            $subscription->status = Yii::$app->params['inactive'];
            $subscription->save();
        }
    }

    public function getPlaceName()
    {
        $place = Place::findOne($this->place_id);

        return $place ? $place->name : '-';
    }
    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }
}