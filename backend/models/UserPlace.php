<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/06/2016
 * Time: 20:24
 */

namespace backend\models;

use Yii;
use common\models\UserPlace as BaseUserPlace;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class UserPlace extends BaseUserPlace
{

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
            [['user_id', 'place_id'], 'required'],
            [['user_id', 'place_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
        ];
    }

    public static function getUsers($place_id)
    {
        $exit_users = self::findAll(['place_id' => $place_id]);
        $user_ids = array();
        if (!empty($exit_users)) :
            foreach ($exit_users as $exit_user) :
                $user_ids[] = $exit_user->user_id;
            endforeach;
        endif;
        return ArrayHelper::map(User::find()
            ->where(['not in', 'id', $user_ids])
            ->andWhere(new Expression('`blocked_at` IS NULL'))
            ->all(), 'id', 'email');
    }
}