<?php

namespace frontend\controllers;

use backend\models\Subscription;
use common\components\BaseController;
use frontend\models\Enquiry;
use Yii;
use frontend\models\ContactForm;
use common\models\Place;
class ContactUsController extends BaseController
{
    public function actionIndex()
    {

        $model = new ContactForm();
        $place = Place::findOne(['id' => 30, 'code' => 'GUIDE00030']);
        $ip_address = Yii::$app->request->getUserIP();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Enquiry::saveEnquiry($place->id, $model);
                Subscription::saveUserToSubscription($model->email);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('fail', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
                'description' => $place->description,
                'ip_address' => $ip_address,

            ]);
        }
    }

}
