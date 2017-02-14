<?php

namespace frontend\controllers;
use Yii;
use backend\models\Category;
use common\components\BaseController;
use yii\data\ArrayDataProvider;

class BasicListController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Category::findOne(['slug' => $slug]);

        if (!is_null($model)) {
            Yii::$app->view->registerMetaTag([
                'name' => 'keywords',
                'content' => [$model->name, ],
            ]);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $model->getFreePlaces(),

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
