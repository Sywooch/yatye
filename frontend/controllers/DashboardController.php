<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Place;
use backend\components\AdminController;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        $places = Place::getMyPlaces();

        if(!empty($places)) :

            return $this->render('index', [
                'places' => $places,
            ]);
        else:
            return $this->redirect(Yii::$app->request->baseUrl . '/place');
        endif;
    }

}
