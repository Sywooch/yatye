<?php

namespace frontend\controllers;
use common\components\BaseController;
use Yii;
use backend\controllers\user\AdminController;
use backend\models\Service;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

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
