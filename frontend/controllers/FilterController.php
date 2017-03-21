<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use yii\helpers\ArrayHelper;
use frontend\models\Filter;
use common\models\Province;
use backend\models\Category;

class FilterController extends BaseController
{
    public function actionIndex()
    {
        $model = new Filter();
        $params = Yii::$app->request->queryParams;
        Yii::warning("queryParams: " . print_r($params, true));
        $dataProvider = $model->filter($params);

        $provinces = ArrayHelper::map(Province::find()->all(), 'id', 'name');
        $categories = ArrayHelper::map(Category::find()
            ->where(['status' => Yii::$app->params['active']])
            ->all(), 'id', 'name');

        return $this->render('index', [
            'params' => $params,
            'model' => $model,
            'provinces' => $provinces,
            'categories' => $categories,
            'dataProvider' => $dataProvider,
        ]);
    }

}
