<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 11/12/2016
 * Time: 12:38
 */

namespace console\controllers;


use backend\models\Place;
use backend\models\Subscription;
use common\helpers\EmailHelper;
use Yii;
use yii\console\Controller;
use backend\models\NewsLetter;

class NewsLetterController extends Controller
{
    public function actionSend()
    {
        $news_letters = NewsLetter::findAll(['status' => 0]);

        if (!empty($news_letters)) {

            foreach ($news_letters as $news_letter) {

//                $send_at = strtotime($news_letter->send_at);
//                $secondsLeft = $send_at - time();
//
//                if ($secondsLeft <= 0) {
//
//                }

//                $news_letter->sendNewsLetter();
            }
        }
    }

    /*This temporary! */
    public function actionTemporary()
    {
        $places = Place::findAll(['status' => Yii::$app->params['active']]);

        if (!empty($places)) {
            foreach ($places as $place) {
                $subscribers = Subscription::findAll([
                    'place' => 1,
                    'status' => Yii::$app->params['inactive'],
                    'place_id' => $place->id,
                ]);

                if (!empty($subscribers)) {
                    foreach ($subscribers as $subscriber) {

                        if (EmailHelper::validEmail($subscriber->email)){
                            EmailHelper::sendActivatedPlaceNotification($place, $subscriber);
                            $subscriber->status = Yii::$app->params['active'];
                            $subscriber->verified = 1;
                            $subscriber->save(0);
                            echo 'Done!';
                        }
                    }
                }
            }
        }


    }
}