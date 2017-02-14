<?php

namespace frontend\controllers;

use backend\models\Category;
use frontend\models\District;
use Yii;
use common\components\BaseController;
use yii\data\ArrayDataProvider;

class DistrictController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
//        $model = Category::find()->where(['slug' => $slug])->one();

        $model = District::findOne(['slug' => $slug]);


        if (!is_null($model)) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name, ],
            ]);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $model->getBasicPlaces(),

            ]);

            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
//                'place_list' => $model->getBasicPlaces(),
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
