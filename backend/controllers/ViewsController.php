<?php

namespace backend\controllers;

use Yii;
use yii\db\Expression;
use frontend\models\Views;
use frontend\models\ViewsList;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
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

    public function actionList($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ViewsList::find()
                ->where(['views_id' => $id])
                ->orderBy(new Expression('`created_at` DESC')),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['attributes' => ['created_at']],
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
