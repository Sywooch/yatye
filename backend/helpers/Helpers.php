<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/06/2016
 * Time: 18:11
 */

namespace backend\helpers;

use backend\models\place\Place;
use Yii;
use common\helpers\Helpers as BaseHelpers;

class Helpers extends BaseHelpers
{

    public static function getList($status)
    {
        $get_places = Place::find();

        if ($status == 'active') {
            $get_places = $get_places->where(['status' => Yii::$app->params['active']]);
        } elseif ($status == 'inactive') {
            $get_places = $get_places->where(['status' => Yii::$app->params['inactive']]);
        } elseif ($status == 'rejected') {
            $get_places = $get_places->where(['status' => Yii::$app->params['rejected']]);
        } elseif ($status == 'pending') {
            $get_places = $get_places->where(['status' => Yii::$app->params['pending']]);
        }
        elseif ($status == 'imported') {
            $get_places = $get_places->where(['status' => Yii::$app->params['imported']]);
        }
        return $get_places;
    }

}