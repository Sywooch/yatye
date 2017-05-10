<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/06/2016
 * Time: 18:11
 */

namespace backend\helpers;

use backend\models\place\Contact;
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
        } elseif ($status == 'imported') {
            $get_places = $get_places->where(['status' => Yii::$app->params['imported']]);
        }
        return $get_places;
    }

    public static function getPlacesWithEmptyFields($attribute)
    {
        $places = Place::getPlacesWithEmptyFields();

        if ($attribute == 'description') {
            $places = $places['descriptions'];
        } elseif ($attribute == 'slug') {
            $places = $places['slugs'];
        } elseif ($attribute == 'logo') {
            $places = $places = $places['logos'];;
        } elseif ($attribute == 'province_id') {
            $places = $places['provinces'];
        } elseif ($attribute == 'district') {
            $places = $places['districts'];
        } elseif ($attribute == 'sector') {
            $places = $places['sectors'];
        } elseif ($attribute == 'cell') {
            $places = $places['cells'];
        } elseif ($attribute == 'neighborhood') {
            $places = $places['neighborhoods'];
        } elseif ($attribute == 'street') {
            $places = $places['streets'];
        } elseif ($attribute == 'latitude') {
            $places = $places['latitudes'];
        } elseif ($attribute == 'longitude') {
            $places = $places['longitudes'];
        } elseif ($attribute == 'profile_type') {
            $places = $places['profile_types'];
        }

        return $places;
    }

    public static function getPlaceIdsByTypes($type, $model)
    {
        $contacts = $model::findAll(['type' => $type]);
        $place_ids = array();
        foreach ($contacts as $contact) {
            $place_ids[] = $contact->place_id;
        }
        return $place_ids;
    }

}