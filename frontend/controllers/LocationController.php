<?php

namespace frontend\controllers;

use backend\models\Category;
use backend\models\Service;
use Yii;
use common\components\BaseController;
use frontend\models\District;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

class LocationController extends BaseController
{
    public function actionIndex()
    {

        $districts = District::getActiveDistricts();

        $dataProvider = new ActiveDataProvider([
            'query' => District::find(),

        ]);

        return $this->render('index', [
            'dataProvider'=>$dataProvider,
            'districts'=>$districts,
        ]);
    }

    public function actionSlug($slug)
    {
        $model = District::findOne(['name'=>$slug]);
        $service_categories = Category::find()->where(['status' => Yii::$app->params['active']])->orderBy('RAND()')->all();

        return $this->render('district', [
            'model' => $model,
            'service_categories' => $service_categories,
        ]);
    }

}
