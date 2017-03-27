<?php

namespace frontend\controllers;

use backend\controllers\user\AdminController;
use common\components\BaseController;
use frontend\models\Ratings;
use frontend\models\RatingsList;
use Yii;
use frontend\models\Place;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class RatingsController extends BaseController
{

    public function actionRate()
    {
        $post = Yii::$app->request->post('Ratings');
        $ip_address = Yii::$app->request->getUserIP();
        $place_id = Yii::$app->request->get('place_id');
        $place = Place::findOne($place_id);

        $existing_rating = Ratings::findOne(['place_id' => $place_id]);

        if (!empty($existing_rating)) {
            $model = $existing_rating;
        } else {
            $model = new Ratings();
        }

        if ($model->load(Yii::$app->request->post())) {

            $transaction = $model->getDb()->beginTransaction();
            try {

                if ($model->isNewRecord) {
                    $model->place_id = $place_id;
                    $model->save();
                } else {
                    $model->save();
                }

                $rating_list = RatingsList::findOne(['rating_id' => $model->id, 'ip_address' => $ip_address]);

                if (!empty($rating_list)) {
                    $rating_list->ratings = $post['ratings'];
                    $rating_list->save(0);
                } else {
                    $rating_list = new RatingsList();
                    $rating_list->rating_id = $model->id;
                    $rating_list->ratings = $post['ratings'];
                    $rating_list->ip_address = $ip_address;
                    $rating_list->save(0);
                }

                $model->saveAverage();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            Yii::$app->session->setFlash('success', 'Thank you for rating this place at ' . $model->average . ' stars. 
            Your result is factored into the average.');
            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
        } else {
            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
        }
    }
}
