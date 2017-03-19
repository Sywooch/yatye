<?php

namespace frontend\controllers;

use Yii;
use backend\models\Category;
use common\components\BaseController;
use common\models\Ads;
use yii\web\NotFoundHttpException;

class ListController extends BaseController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Category::find()->where(['slug' => $slug])->one();


        if (!is_null($model)) {
            return $this->render('index', [
                'model' => $model,
                'place_list' => $model->getCategoryList(),
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

}
