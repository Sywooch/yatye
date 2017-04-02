<?php

namespace frontend\controllers;

use Yii;
use yii\db\Expression;
use backend\models\post\Post;
use yii\data\ActiveDataProvider;
use common\components\BaseController;

class ArchivesController extends BaseController
{
    public function actionIndex()
    {
        $month = Yii::$app->request->get('month');
        $year = Yii::$app->request->get('year');

        $query = Post::find()
            ->where(new Expression('Month(`updated_at`) = ' . $month . ' AND Year(`updated_at`) = ' . $year))
            ->orderBy(['updated_at' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
