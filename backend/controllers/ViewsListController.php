<?php

namespace backend\controllers;

use Yii;
use frontend\models\ViewsList;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use backend\components\AdminController as BackendAdminController;
use yii\db\Expression;

class ViewsListController extends BackendAdminController
{
    public function actionIndex()
    {
        $views_id = Yii::$app->request->get('views_id');

        $dataProvider = new ActiveDataProvider([
            'query' => ViewsList::find()
                ->where(['views_id' => $views_id])
                ->orderBy(new Expression('`created_at` DESC')),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => ['attributes' => ['created_at']],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
