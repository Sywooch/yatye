<?php

namespace frontend\controllers;

use backend\models\Pricing;
use Yii;
use common\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class PricingController extends BaseController
{
    public function actionIndex()
    {
//        echo 'I am here!';
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ['Pricing'],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => Pricing::find()->where(['status' => Yii::$app->params['publish']]),

        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

//    public function actionSlug($slug)
//    {
//        $model = Pricing::findOne(['slug' => $slug]);
//
//        if (!is_null($model)) {
//            Yii::$app->view->registerMetaTag([
//                'name' => 'keywords',
//                'content' => [$model->title, 'Rwanda', 'Kigali', 'Rwanda Guide'],
//            ]);
//            return $this->render('index', [
//                'model' => $model,
//            ]);
//        } else {
//            return $this->redirect(Url::to(['index']));
//        }
//    }
}
