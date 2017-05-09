<?php

namespace backend\controllers;

use Yii;
use yii\db\Expression;
use yii\helpers\Inflector;
use common\models\Province;
use backend\helpers\Helpers;
use yii\helpers\ArrayHelper;
use backend\models\place\Place;
use yii\data\ActiveDataProvider;
use backend\models\place\Category;
use backend\models\place\SearchPlace;
use backend\components\AdminController as BackendAdminController;

class PlaceController extends BackendAdminController
{
    public function actionIndex()
    {
        //Values from search form
        $post = Yii::$app->request->post('Place');
        $searchModel = new SearchPlace();
        if ($post) {
            $dataProvider = new ActiveDataProvider([
                'query' => Place::searchPlaces($post),
            ]);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        $status = Helpers::getStatus();
        $profile_types = Helpers::getProfileType();
        $provinces = ArrayHelper::map(Province::find()->all(), 'id', 'name');
        $categories = ArrayHelper::map(Category::find()->where(['status' => Yii::$app->params['active']])->all(), 'id', 'name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'provinces' => $provinces,
            'categories' => $categories,
            'profile_types' => $profile_types,
            'status' => $status,
        ]);

    }

    public function actionList()
    {
        $status = Yii::$app->request->get('status');
        $attribute = Yii::$app->request->get('attribute');

        $get_places = array();

        if ($status){
            $get_places = Helpers::getList($status)->orderBy(new Expression('created_at DESC'));
        }

        if ($attribute){
            $get_places = Helpers::getPlacesWithEmptyFields($attribute);
        }



        $dataProvider = new ActiveDataProvider([
            'query' => $get_places,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReject()
    {
        $model = Place::findOne(Yii::$app->request->get('id'));

        if (!is_null($model) && $model->status == Yii::$app->params['inactive']) :
            $model->status = Yii::$app->params['rejected'];
            $model->save(0);
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Place is successfully rejected!'));
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Place is not rejected!'));
        endif;

        return $this->redirect(['list', 'status' => 'inactive']);
    }

    public function actionUpgrade()
    {
        $model = Place::findOne(Yii::$app->request->get('id'));

        if (!is_null($model)) :
            if ($model->profile_type == Yii::$app->params['NOT_DEFINED']) :
                $model->profile_type = Yii::$app->params['FREE'];
                $model->save(0);
            elseif ($model->profile_type == Yii::$app->params['FREE']) :
                $model->profile_type = Yii::$app->params['BASIC'];
                $model->save(0);
            elseif ($model->profile_type == Yii::$app->params['BASIC']) :
                $model->profile_type = Yii::$app->params['PREMIUM'];
                $model->save(0);
            endif;

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Place is successfully upgraded!'));
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Place is not upgraded!'));
        endif;

        return $this->redirect(['index']);
    }

    public function actionDowngrade()
    {
        $model = Place::findOne(Yii::$app->request->get('id'));

        if (!is_null($model)) :
            if ($model->profile_type == Yii::$app->params['PREMIUM']) :
                $model->profile_type = Yii::$app->params['BASIC'];
                $model->save(0);
            elseif ($model->profile_type == Yii::$app->params['BASIC']) :
                $model->profile_type = Yii::$app->params['FREE'];
                $model->save(0);
            elseif ($model->profile_type == Yii::$app->params['FREE']) :
                $model->profile_type = Yii::$app->params['NOT_DEFINED'];
                $model->save(0);
            endif;

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Place is successfully downgraded!'));
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Place is not downgraded!'));
        endif;

        return $this->redirect(['index']);
    }

    public function getAllControllerActions()
    {
        $controllers = \yii\helpers\FileHelper::findFiles(Yii::getAlias('@backend/controllers'), ['recursive' => true]);
        $actions = [];
        foreach ($controllers as $controller) {
            $contents = file_get_contents($controller);
            $controllerId = Inflector::camel2id(substr(basename($controller), 0, -14));
            preg_match_all('/public function action(\w+?)\(/', $contents, $result);
            foreach ($result[1] as $action) {
                $actionId = Inflector::camel2id($action);
                $route = $controllerId . '/' . $actionId;
                $actions[$route] = $route;
            }
        }
        asort($actions);
        return $actions;
    }


}
