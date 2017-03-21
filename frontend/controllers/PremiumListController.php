<?php

namespace frontend\controllers;

use Yii;
use backend\models\Category;
use yii\data\ActiveDataProvider;
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
        $session = Yii::$app->session;
        $session->set('category_id', $model->id);

        if (!is_null($model)) {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getBasicList(),

            ]);

            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }
}
