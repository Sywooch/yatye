<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/12/2016
 * Time: 15:29
 */

namespace console\controllers;

use backend\models\Contact;
use backend\models\Place;
use backend\models\Subscription;
use common\models\User;
use Yii;
use yii\console\Controller;

class SubscriptionController extends Controller
{
    public function actionAddList()
    {


        $places = Place::findAll(['status' => Yii::$app->params['active']]);

        $users = User::find()->all();

        if (!empty($places)) {
            foreach ($places as $place) {
                $emails = Contact::findAll(['type' => Yii::$app->params['EMAIL'], 'place_id' => $place->id]);
                if (!empty($emails)) {
                    foreach ($emails as $email) {
                        Subscription::savePlaceToSubscription($email->name, $email->place_id);
                    }
                }
            }
        }

        if (!empty($users)) {
            foreach ($users as $user) {
                Subscription::saveUserToSubscription($user->email);
            }
        }
    }
}