<?php

namespace frontend\controllers;

use frontend\models\Place;
use Yii;
use backend\models\Category;

use backend\components\AdminController;

class NearbyPlacesController extends AdminController
{
    public function actionIndex()
    {
        $model = Category::findOne(Yii::$app->request->get('category_id'));

//        $places = Category::getNearbyPlaces(Yii::$app->request->get('distance'));

        return $this->render('index', [
            'places' => $model->getNearbyPlaces(Yii::$app->request->get('distance')),
        ]);
    }

    public function actionSearch()
    {
        $model = new Category();

        //Get post values from search form
        $POST_VARIABLE = Yii::$app->request->post('Place');

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ['nearby-places', 'Rwanda Guide'],
        ]);
        return $this->render('index', [
            'places' => $model->searchPlaces($POST_VARIABLE),
        ]);
    }
}
