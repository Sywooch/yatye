<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\helpers\Helpers;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\helpers\RecordHelpers;
use backend\models\place\Service;
use backend\models\place\Category;
use yii\web\NotFoundHttpException;
use backend\models\place\PlaceService;
use backend\components\AdminController as BackendAdminController;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends BackendAdminController
{
    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Service::find(),
        ]);

        $model = new  Service();

        $categories = Category::getAllCategories();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();

        $categories = ArrayHelper::map(Category::getAllCategories(), 'id', 'name');
        $types = Helpers::getServiceTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Service added successfully!'));
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'types' => $types,
            ]);
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categories = ArrayHelper::map(Category::getAllCategories(), 'id', 'name');
        $types = Helpers::getServiceTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'types' => $types,
            ]);
        }
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddPlaces()
    {
        $service_id = Yii::$app->request->get('service_id');
        $session = Yii::$app->session;
        $session->set('service_id', $service_id);

        $POST_VARIABLE = Yii::$app->request->post('PlaceService');
        $model = Service::findOne($service_id);

        $url = Url::to(['service/add-places', 'service_id' => $service_id]);

        $place_service = new PlaceService();
        $available_places = PlaceService::getNotServicePlaces($service_id);
        $places = $model->getPlaces();

        if (Yii::$app->request->isPost) {

            foreach ($POST_VARIABLE['place_id'] as $key => $place_id) {

                $model = new PlaceService();
                RecordHelpers::saveModelHasData($model, 'service_id', 'place_id', $service_id, $place_id);
            }

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Places successfully added.'));
            return $this->redirect($url);
        }
        else{

            $dataProvider = new ActiveDataProvider([
                'query' => $model->getList(),
                'pagination' => [
                    'pageSize' => 20,
                ],
                'sort' => ['attributes' => ['name']],
            ]);

            return $this->render('add_places', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'place_service' => $place_service,
                'available_places' => $available_places,

            ]);
        }
    }
}
