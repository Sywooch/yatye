<?php

namespace frontend\controllers;

use backend\controllers\user\AdminController;
use common\components\BaseController;
use frontend\models\Ratings;
use Yii;
use frontend\models\Place;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class RatingsController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionRate()
    {

        $model = new Ratings();
        $ip_address = Yii::$app->request->getUserIP();


        if ($model->load(Yii::$app->request->post())) {

            $model->ip = $ip_address;
            $POST_VARIABLE = Yii::$app->request->post('Ratings');
            $existingRating = Ratings::find()
                ->where(['place_id' => $POST_VARIABLE['place_id']])
                ->andWhere(['ip' => $ip_address])
                ->one();
            try {
                if ($existingRating) {

                    $existingRating->ratings = $model->ratings;
                    if ($existingRating->save(0)) {

                        $place = Place::findOne($existingRating->place_id);
                        Yii::$app->session->setFlash('success', 'Thank you for updating this place to ' . $existingRating->ratings . ' stars.  Your result is factored into the average.');

                        return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
                    }
                } else {

                    if ($model->save(0)) {

                        $place = Place::findOne($model->place_id);
                        Yii::$app->session->setFlash('success', 'Thank you for rating this place at ' . $model->ratings . ' stars. Your result is factored into the average.');

                        return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
                    }

                }

            } catch (\Exception $e) {
                //error
            }
        }
    }
}
