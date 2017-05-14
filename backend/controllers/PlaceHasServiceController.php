<?php

namespace backend\controllers;

use Yii;
use common\helpers\RecordHelpers;
use backend\models\place\PlaceHasService;
use backend\components\AdminController as BackendAdminController;

class PlaceHasServiceController extends BackendAdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDeleteItem()
    {
        $place_id = Yii::$app->request->get('place_id');
        $service_id = Yii::$app->request->get('service_id');

        $model = PlaceHasService::findOne(['place_id' => $place_id, 'service_id' => $service_id]);
        $url = Yii::$app->request->baseUrl . '/service/add-places?service_id=' . $service_id;

        RecordHelpers::deleteOneRecord($model);
        return $this->redirect($url);

    }

}
