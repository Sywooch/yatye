<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/12/2016
 * Time: 15:06
 */

namespace common\helpers;

use Yii;

class EmailHelper
{

    public static function sendEmail($to, $subject, $body)
    {
        $message = Yii::$app->mailer->compose();

        $message->setFrom([Yii::$app->params['adminEmail'] => 'Rwanda Guide'])
//            ->setTo($to)// for production
            ->setTo('rwandaguide.info@gmail.com')// for test
            ->setCc(Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            ->setHtmlBody($body);

        if ($message->send()) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendEnquiryEmail($profile, $to, $contact_form)
    {
        $body = self::htmlTemplate(self::enquiryBody($profile, $contact_form), self::htmlFooter());

        if (self::sendEmail($to, $contact_form->subject, $body)) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendActivatedPlaceNotification($model, $subscriber)
    {
        $subject = 'Your profile at Rwanda Guide is activated';
        $content = NotificationHelper::activatedPlaceNotification($model);

        $unsubscribe_url = Yii::$app->params['root'] . 'unsubscribe?id=' . $subscriber->id . '&type=places';
        $footer = self::htmlFooter($unsubscribe_url);

        $body = self::htmlTemplate(self::activatedPlaceBody($model->name, $content), $footer);

        if (self::sendEmail($subscriber->email, $subject, $body)) {
            return true;
        } else {
            return false;
        }
    }

    public static function sendNewsLetterEmail($subscriber, $model, $place = null)
    {
        if ($place != null){
            $url = Yii::$app->params['root'] . 'place-details/' . $place->slug;
        }else{
            $url = null;
        }


        if ($model->type == 'visitors') {
            $unsubscribe_url = Yii::$app->params['root'] . 'unsubscribe?id=' . $subscriber->id . '&type=' . $model->type;
            $footer = self::htmlFooter($unsubscribe_url, 'You received this email because you have subscribed to receive newsletters from');
        } elseif ($model->type == 'places') {
            $unsubscribe_url = Yii::$app->params['root'] . 'unsubscribe?id=' . $subscriber->id . '&type=' . $model->type;
            $footer = self::htmlFooter($unsubscribe_url);
        } elseif ($model->type == 'users') {
            $unsubscribe_url = Yii::$app->params['root'] . 'unsubscribe?id=' . $subscriber->id . '&type=' . $model->type;
            $footer = self::htmlFooter($unsubscribe_url, 'You received this email because you have an account at');
        } elseif ($model->type == 'all') {
            $unsubscribe_url = Yii::$app->params['root'] . 'unsubscribe?id=' . $subscriber->id . '&type=' . $model->type;
            $footer = self::htmlFooter($unsubscribe_url, 'You received this email because you are in subscription list at');
        } else {
            $footer = '';
        }

        $body = self::htmlTemplate(self::newsLetterBody($model->message, $url), $footer);

        if (self::sendEmail($subscriber->email, $model->subject, $body)) {
            return true;
        } else {
            return false;
        }
    }

    private static function activatedPlaceBody($place_name, $content)
    {
        $body = '';
        $body .= 'Congratulations, <b>' . $place_name . '</b>!<br><br>';
        $body .= nl2br($content);

        return $body;
    }

    private static function enquiryBody($profile, $contact_form)
    {
        $body = '';
        $body .= 'Hello <b>' . $profile . '</b>,<br><br>';
        $body .= '<b>' . $contact_form->name . '</b> (' . $contact_form->email . ') ' . 'has sent you a message: <br><br>';
        $body .= nl2br($contact_form->body);

        return $body;
    }

    private static function newsLetterBody($from_body, $url = null)
    {
        $body = '';
        $body .= nl2br($from_body);

//        if ($url != null){
//            $body .= '<p>Note : You can check out your current profile <a style="color: #c6af5c;text-decoration: underline;" href="' . $url . '" target="_blank">here</a>.</p>';
//        }

        return $body;
    }

    private static function htmlFooter($unsubscribe_url = null, $text = 'You received this email because you are featured in')
    {
        $html = '';
        $html .= '<tr>
                    <td>
                        <div style="font-size: 12px;line-height: 8px;text-align: center;">
                            <p>' . $text . ' <a style="color: #c6af5c;text-decoration: underline;" title="Rwanda Guide" href="http://rwandaguide.info" target="_blank">Rwanda Guide.</a></p>
                            <p> If you\'d prefer not to receive this email, you can <a style="color: #c6af5c;text-decoration: underline;" href="' . $unsubscribe_url . '" target="_blank">unsubscribe</a></p>
                        </div>
                    </td>
                </tr>';
        return $html;
    }

    private static function htmlTemplate($content, $footer = null)
    {
        $html = '';
        $html .= '<table style="line-height: 28px;color: #000000; width: 100% !important;height:100%;background:#ffffff;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust: none;">';

        $html .= '<tr>';
        $html .= '<td style="display: block !important;clear: both !important;margin: 0 auto !important;max-width: 580px !important;">';
        $html .= '<table>
                <tr>
                    <td align="center" style="padding: 20px 0;background: #ffffff;color: white;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block;border: none;height: auto;line-height: 100%;margin: 0 auto;float: none;width: 100% !important;max-width: 166.666666666667px">
                        <img style="max-width: 100%;margin: 0 auto;display: block;" src="' . Yii::$app->params["logo_320"] . '">
                    </td>
                </tr>
                <tr>
                    <td style="background: white;padding: 10px 25px;" >
                        ' . $content . '
                    </td>
                </tr>
            </table>';
        $html .= '</td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td style="display: block !important;clear: both !important;margin: 0 auto !important;max-width: 580px !important;">';
        $html .= '<table style="margin: 0 auto;">';
        $html .= '<tr><td><hr></td></tr>';

        if ($footer != null) {
            $html .= $footer;
        }

        $html .= '<tr>
                    <td style="font-size: 12px;line-height: 8px;text-align: center;">
                        <p>Sent by <a style="color: #c6af5c;text-decoration: underline;" href="http://rwandaguide.info" target="_blank">Rwanda Guide</a>, KN 185 St, Kigali Nyakabanda Nyarugenge</p>
                        <p><a style="color: #c6af5c;text-decoration: underline;" href="mailto:">rwandaguide@rwandaguide.info</a></p>
                    </td>
                </tr>';

        $html .= '<tr>
                    <td style="background: none;" align="center">
                        <div style="width: 100%;display: block;margin: 0 auto;">
                            <ul style="list-style-type: none;">
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["facebook"] . '" class="social-icon" target="_blank">
                                        <img src="' . Yii::$app->params["facebook_icon"] . '" width="32" title="Facebook" alt="Facebook">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["twitter"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["twitter_icon"] . '" width="32" title="Twitter" alt="Twitter">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["google-plus"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["google-plus_icon"] . '" width="32" title="Google Plus" alt="Google Plus">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["pinterest"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["pinterest_icon"] . '" width="32" title="Pinterest" alt="Pinterest">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["instagram"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["instagram_icon"] . '" title="Instagram" width="32" alt="Instagram">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["tumblr"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["tumblr_icon"] . '" title="Tumblr" width="32" alt="Tumblr">
                                    </a>
                                </li>
                                <li style="float: left;">
                                    <a style="color: #c6af5c;text-decoration: underline;" href="' . Yii::$app->params["youtube"] . '" target="_blank">
                                        <img src="' . Yii::$app->params["youtube_icon"] . '" title="Youtube" width="32" alt="Youtube">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>';

        $html .= '';
        $html .= '';

        $html .= '</table>';
        $html .= '</td>';
        $html .= '</tr>';


        $html .= '</table>';

        return $html;
    }

    public static function validEmail($email)
    {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }

        return true;
    }
}