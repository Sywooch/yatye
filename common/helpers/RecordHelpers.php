<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/04/2016
 * Time: 15:00
 */

namespace common\helpers;

use backend\models\Gallery;
use frontend\models\UserProfile;
use Yii;

class RecordHelpers
{

    public static function userHas($model_name)
    {
        $connection = Yii::$app->db;
        $userid = Yii::$app->user->identity->id;
        $sql = "SELECT id FROM $model_name WHERE user_id=:userid";
        $command = $connection->createCommand($sql);
        $command->bindValue(":userid", $userid);
        $result = $command->queryOne();

        if ($result == null) {

            return false;

        } else {

            return $result['id'];

        }

    }

    public static function placeServiceSaveData($model, $model_service_id, $model_place_id, $place_id, $service_id)
    {
        $model->$model_place_id = $place_id;
        $model->$model_service_id = $service_id;
        $model->status = Yii::$app->params['active'];
        $model->save(0);
    }

    public static function saveModelHasData($model, $model_id_a, $model_id_b, $id_a, $id_b)
    {
        $model->$model_id_a = $id_a;
        $model->$model_id_b = $id_b;
        $model->save(0);
    }


    public static function getUserProfile()
    {

        if (!Yii::$app->user->isGuest) {
            return UserProfile::findOne(['user_id' => Yii::$app->user->identity->id]);
        } else {

            return null;
        }
    }

    public static function profilePicture()
    {

        $model = self::getUserProfile();

        if ($model !== null) {

            return $model;
        } else {

            return new UserProfile();
        }
    }

    public static function hasProfile()
    {

        if (self::getUserProfile()) {

            return true;
        } else {

            return false;
        }
    }

    public static function getProfilePicture()
    {

        $model = self::getUserProfile();

        if ($model !== null && $model->avatar !== null) {
            return Yii::$app->params['profile-picture'] . $model->avatar;
        } else {

            return Yii::$app->params['default'];
        }

    }

    public static function status($model)
    {

        if ($model->status == Yii::$app->params['inactive']) :
            $model->status = Yii::$app->params['active'];
            $model->save(0);
        else:
            $model->status = Yii::$app->params['inactive'];
            $model->save(0);
        endif;

    }

    public static function logo($model, $place)
    {
        if ($model->logo == 'no') {
            if ($place !== null) {
                $model->logo = 'yes';
                $model->save(0);

                $place->logo = $model->name;
                $place->save(0);
            }
        } else {
            $model->logo = 'no';
            $model->save(0);
        }

        $gallery = Gallery::findAll(['place_id' => $place->id]);
        foreach ($gallery as $photo):
            $photo->logo = 'no';
            $photo->save(0);
        endforeach;
    }

    public static function deleteOneRecord($model)
    {
        if ($model->delete()) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Item successfully deleted.'));
        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Item is not deleted!'));
        }
    }

}