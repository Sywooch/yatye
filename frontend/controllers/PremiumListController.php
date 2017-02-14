<?php

namespace frontend\controllers;

use Yii;
use backend\models\Category;
use yii\data\ArrayDataProvider;
use common\components\BaseController;

class PremiumListController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Category::findOne(['slug' => $slug]);

        if (!is_null($model)) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name, ],
            ]);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $model->getPremiumAndBasicPlaces(),

            ]);

            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
//                'place_list' => $model->getPremiumPlaces(),
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }
}
