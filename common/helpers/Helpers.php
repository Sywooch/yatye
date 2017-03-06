<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 20/02/2016
 * Time: 14:41
 */

namespace common\helpers;

use backend\models\Gallery;
use Yii;
use yii\helpers\FileHelper;

class Helpers
{

    public static function invertIndexesInArray($array)
    {

        $new_array = array();

        foreach ($array as $i => $element):
            foreach ($element as $j => $sub_element) {
                $new_array[$j] = $sub_element;
            }
        endforeach;

        return $new_array;
    }

    public function buildAnArray($query, $index, $value)
    {

        $new_array = array();

        foreach ($query as $i => $val):
            $new_index = $val[$index];
            $new_value = $val[$value];
            array_push($new_array, [$new_index => $new_value]);
        endforeach;

        return $this->invertIndexesInArray($new_array);

    }


    public static function getStatus()
    {

        $status = array();

        for ($i = 0; $i <= 5; $i++) {

            if ($i == Yii::$app->params['active']):
                $status[] = [$i => Yii::t('app', 'Active')];
            elseif ($i == Yii::$app->params['inactive']):
                $status[] = [$i => Yii::t('app', 'Inactive')];
            elseif ($i == Yii::$app->params['pending']):
                $status[] = [$i => Yii::t('app', 'Pending')];
            elseif ($i == Yii::$app->params['rejected']):
                $status[] = [$i => Yii::t('app', 'Reject')];
            endif;
        }

        return self::invertIndexesInArray($status);
    }

    public static function getProfileType()
    {

//        $profile_type = array();
//
//        for ($i = 0; $i <= 5; $i++) {
//
//            if ($i == Yii::$app->params['PREMIUM']):
//                $profile_type[] = [$i => Yii::t('app', 'Premium')];
//            elseif ($i == Yii::$app->params['BASIC']):
//                $profile_type[] = [$i => Yii::t('app', 'Basic')];
//            elseif ($i == Yii::$app->params['FREE']):
//                $profile_type[] = [$i => Yii::t('app', 'Free')];
//            endif;
//        }
//
//        return self::invertIndexesInArray($profile_type);

        return array_combine(
            [
                Yii::$app->params['PREMIUM'],
                Yii::$app->params['BASIC'],
                Yii::$app->params['FREE'],
                Yii::$app->params['NOT_DEFINED'],
            ],
            [
                Yii::t('app', 'Premium'),
                Yii::t('app', 'Basic'),
                Yii::t('app', 'Free'),
                Yii::t('app', 'Not Defined'),
            ]
        );
    }

    public static function getDistances()
    {

        $distance = array();

        for ($i = 0.5; $i <= 5; $i += 0.5) {

            array_push($distance, [self::convertFloat($i) => $i . ' Km']);
        }

        return self::invertIndexesInArray($distance);
    }

    public static function convertFloat($floatAsString)
    {
        $norm = strval(floatval($floatAsString));

        if (($e = strrchr($norm, 'E')) === false) {
            return $norm;
        }

        return number_format($norm, -intval(substr($e, 1)));
    }

    public static function getContactTypes()
    {

        $contact_type = array();

        for ($i = 1; $i <= 10; $i++) {

            if ($i == Yii::$app->params['PHYSICAL_ADDRESS']):
                $contact_type[] = [$i => Yii::t('app', 'Physical address')];
            elseif ($i == Yii::$app->params['PO_BOX']):
                $contact_type[] = [$i => Yii::t('app', 'P.O Box')];
            elseif ($i == Yii::$app->params['MOB_PHONE']):
                $contact_type[] = [$i => Yii::t('app', 'Mobile phone number')];
            elseif ($i == Yii::$app->params['LAND_LINE']):
                $contact_type[] = [$i => Yii::t('app', 'Land line phone number')];
            elseif ($i == Yii::$app->params['FAX']):
                $contact_type[] = [$i => Yii::t('app', 'Fax number')];
            elseif ($i == Yii::$app->params['EMAIL']):
                $contact_type[] = [$i => Yii::t('app', 'Email address')];
            elseif ($i == Yii::$app->params['WEBSITE']):
                $contact_type[] = [$i => Yii::t('app', 'Website')];
            elseif ($i == Yii::$app->params['SKYPE']):
                $contact_type[] = [$i => Yii::t('app', 'Skype')];
            endif;
        }

        return self::invertIndexesInArray($contact_type);
    }

    public static function getServiceTypes()
    {

        $service_type = array();

        for ($i = 1; $i <= 5; $i++) {

            if ($i == Yii::$app->params['A_TYPE']):
                $service_type[] = [$i => Yii::t('app', 'A')];
            elseif ($i == Yii::$app->params['B_TYPE']):
                $service_type[] = [$i => Yii::t('app', 'B')];
            elseif ($i == Yii::$app->params['C_TYPE']):
                $service_type[] = [$i => Yii::t('app', 'C')];
            elseif ($i == Yii::$app->params['D_TYPE']):
                $service_type[] = [$i => Yii::t('app', 'D')];
            elseif ($i == Yii::$app->params['E_TYPE']):
                $service_type[] = [$i => Yii::t('app', 'E')];
            endif;
        }

        return self::invertIndexesInArray($service_type);
    }

    public static function getSocialTypes()
    {

        $social_type = array();

        for ($i = 1; $i <= 10; $i++) {

            if ($i == Yii::$app->params['FACEBOOK']):
                $social_type[] = [$i => Yii::t('app', 'Facebook')];
            elseif ($i == Yii::$app->params['TWITTER']):
                $social_type[] = [$i => Yii::t('app', 'Twitter')];
            elseif ($i == Yii::$app->params['INSTAGRAM']):
                $social_type[] = [$i => Yii::t('app', 'Instagram')];
            elseif ($i == Yii::$app->params['LINKEDIN']):
                $social_type[] = [$i => Yii::t('app', 'Linkedin')];
            elseif ($i == Yii::$app->params['PINTREST']):
                $social_type[] = [$i => Yii::t('app', 'Pintrest')];
            elseif ($i == Yii::$app->params['TUMBLR']):
                $social_type[] = [$i => Yii::t('app', 'Tumblr')];
            elseif ($i == Yii::$app->params['YOUTUBE']):
                $social_type[] = [$i => Yii::t('app', 'Youtube')];
            elseif ($i == Yii::$app->params['GOOGLE_PLUS']):
                $social_type[] = [$i => Yii::t('app', 'Google Plus')];
            elseif ($i == Yii::$app->params['FLICKLR']):
                $social_type[] = [$i => Yii::t('app', 'Flicklr')];
            elseif ($i == Yii::$app->params['TRIPADVISOR']):
                $social_type[] = [$i => Yii::t('app', 'TripAdvisor')];
            endif;
        }

        return self::invertIndexesInArray($social_type);
    }


    public static function getDataInArray($models)
    {

        $carray = array();

        if (is_array($models)) {
            foreach ($models as $model => $val):
                $id = $val['id'];
                $name = $val['name'];
                array_push($carray, [$id => $name]);
            endforeach;
        }
        return self::invertIndexesInArray($carray);
    }

    public static function getSizes()
    {
        return array_combine(
            [
                Yii::$app->params['468x60'],
                Yii::$app->params['840x120'],
                Yii::$app->params['250x250'],
                Yii::$app->params['260x400'],
                Yii::$app->params['180x150'],
                Yii::$app->params['240x200'],
            ],
            [
                '468x60',
                '840x120',
                '250x250',
                '260x400',
                '180x150',
                '240x200',
            ]
        );
    }

    public static function makDir($path)
    {
        if (!is_dir($path)) {
            if (FileHelper::createDirectory($path, 0777, true) === false) {
                return false;
            } else {
                return true;
            }
        }
        else {
            return true;
        }
    }
}