<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\post\PostCategory;
use common\components\BaseController;

class PostCategoryController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = PostCategory::findOne(['slug' => $slug]);

        if ($model) {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getPosts(),

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
