<?php

namespace frontend\controllers;


use Yii;
use frontend\models\District;
use yii\data\ActiveDataProvider;
use backend\models\place\Category;
use common\components\BaseController;

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
