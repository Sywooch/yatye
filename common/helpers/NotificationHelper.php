<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/12/2016
 * Time: 18:34
 */

namespace common\helpers;

use Yii;

class NotificationHelper
{
    public static function activatedPlaceNotification($model)
    {
        $url = Yii::$app->params['root'] . 'place-details/' . $model->slug;

        $text = '';
        $text .= 'We are pleased to inform you that you are now in our directory & listing.';
        $text .= '<br/>';
        $text .= 'Rwanda Guide is the platform that allows you to advertise your products and services online so you can reach out to new customers. ';
        $text .= '<br/>';
        $text .= 'We are looking forward to collaborating with you for our further services that we offer.';
        $text .= '<br/>';
        $text .= 'You can check out your current profile <a style="color: #c6af5c;text-decoration: underline;" href="' . $url . '" target="_blank">here</a>.';
        $text .= '<br/>';
        $text .= 'Please don\'t hesitate to let us know if there are some information on your profile that you want to change.';
        $text .= '';

        return $text;
    }
}