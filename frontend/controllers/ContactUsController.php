<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use common\models\Place;
use frontend\models\Enquiry;
use frontend\models\ContactForm;
use common\components\BaseController;
use backend\models\place\Subscription;

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

    public static function accessData()
    {
        return [
            'get_keywords' => DataHelpers::getKeywords(),
            'all_categories' => DataHelpers::getAllCategories(),
        ];
    }

}
