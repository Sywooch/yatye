<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
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

    public static function accessData()
    {
        return [
            'get_keywords' => DataHelpers::getKeywords(),
            'all_categories' => DataHelpers::getAllCategories(),
        ];
    }
}
