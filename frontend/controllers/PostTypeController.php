<?php

namespace frontend\controllers;

use Yii;
use backend\models\PostType;
use common\components\BaseController;
use yii\data\ActiveDataProvider;

class PostTypeController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = PostType::findOne(['slug' => $slug]);

        if ($model) {

            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name,],
            ]);


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
