<?php

namespace backend\controllers;

use Yii;
use frontend\models\Views;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use backend\components\AdminController as BackendAdminController;

class ViewsController extends BackendAdminController
{
    public function actionIndex()
    {
        $get_views = Views::getViews();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $get_views,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['attributes' => ['views', 'name']],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {

    }

}
