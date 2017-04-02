<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/04/2016
 * Time: 14:58
 */

namespace common\helpers;

use yii;
use backend\models\User;
use frontend\models\UserProfile;

class ValueHelpers
{
    public static function getUser($model)
    {
        $user_profile = UserProfile::findOne(['user_id' => $model->created_by]);
        if (!empty($user_profile)) {
            return $user_profile->first_name . ' ' . $user_profile->last_name;
        }
        else{
            $user = User::find()->where(['id' => $model->created_by])->orWhere(['id' => $model->updated_by])->one();
            return $user->username;
        }
    }

    public static function getStatus($model)
    {
        if ($model->status == Yii::$app->params['active']) {
            $status = Yii::t('app', 'Active');
        } elseif ($model->status == Yii::$app->params['inactive']) {
            $status = Yii::t('app', 'Inactive');
        } elseif ($model->status == Yii::$app->params['pending']) {
            $status = Yii::t('app', 'Pending');
        } elseif ($model->status == Yii::$app->params['rejected']) {
            $status = Yii::t('app', 'Rejected');
        } elseif ($model->status == Yii::$app->params['draft']) {
            $status = Yii::t('app', 'Draft');
        } else {
            $status = Yii::t('app', 'Not set');
        }
        return $status;
    }
}