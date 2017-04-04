<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\post\PostType;
use common\components\BaseController;

class PostTypeController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = PostType::findOne(['slug' => $slug]);

        if (!empty($model)) {
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
