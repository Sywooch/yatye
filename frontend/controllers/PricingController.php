<?php

namespace frontend\controllers;

use Yii;
use backend\models\Pricing;
use yii\data\ActiveDataProvider;
use common\components\BaseController;

class PricingController extends BaseController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pricing::find()->where(['status' => Yii::$app->params['publish']]),

        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
