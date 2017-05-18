<?php

namespace frontend\controllers;

use common\helpers\DataHelpers;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\place\Service;
use common\components\BaseController;

class ServiceController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Service::findOne(['slug' => $slug]);

        if (!is_null($model)) {

            $dataProvider = new ActiveDataProvider([
                'query' => $model->getList(),

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
