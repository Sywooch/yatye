<?php

namespace backend\controllers;

use backend\components\AdminController as BackendAdminController;
use common\models\Export;
use yii\data\ActiveDataProvider;

class CustomerManagementController extends BackendAdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Export::find()->orderBy('name'),
            'pagination'=>['pageSize'=>500],
        ]);

//        $dataProvider = Export::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
