<?php

namespace backend\controllers;

use Yii;
use backend\models\WorkingHours;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * WorkingHoursController implements the CRUD actions for WorkingHours model.
 */
class WorkingHoursController extends BackendAdminController
{

    /**
     * Lists all WorkingHours models.
     * @return mixed
     */
    public function actionIndex()
    {
        $place_id = Yii::$app->request->get('place_id');

        if ($place_id) {

            $working_hours = WorkingHours::find()->where(['place_id' => $place_id])->orderBy('id')->all();

            $dataProvider = new ActiveDataProvider([
                'query' => WorkingHours::find(),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'working_hours' => $working_hours,
            ]);
        }
    }

    /**
     * Displays a single WorkingHours model.
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
     * Creates a new WorkingHours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WorkingHours();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WorkingHours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $place_id = Yii::$app->request->get('place_id');

        if ($place_id) {

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'place_id' => $place_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing WorkingHours model.
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
     * Finds the WorkingHours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkingHours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkingHours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
