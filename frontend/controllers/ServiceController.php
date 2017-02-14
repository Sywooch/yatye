<?php

namespace frontend\controllers;
use common\components\BaseController;
use Yii;
use backend\controllers\user\AdminController;
use backend\models\Service;
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
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name, ],
            ]);
//            $get_services = $model->getPlacesFromService();
//
//            $count = $get_services->count();
//            $pagination = new Pagination([
//                'defaultPageSize' => 30,
//                'totalCount' => $count,
//            ]);
//            $services = $get_services
//                ->offset($pagination->offset)
//                ->limit($pagination->limit)
//                ->all();


            $dataProvider = new ArrayDataProvider([
                'allModels' => $model->getPlacesFromService(),

            ]);

            return $this->render('index', [
                'model' => $model,
                'dataProvider' => $dataProvider,
//                'services' => $services,
//                'pagination' => $pagination,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }


}
