<?php

namespace backend\controllers;

use backend\models\Client;
use common\helpers\Helpers;
use Yii;
use backend\models\Contract;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * ContractController implements the CRUD actions for Contract model.
 */
class ContractController extends BackendAdminController
{

    /**
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Contract::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contract model.
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
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contract();
        $status = Helpers::getStatus();
        $clients = ArrayHelper::map(Client::find()->orderBy('name')->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $file = $model->uploadContractFile();
            $path = $model->getContractFile($model->id);

            if (Helpers::makDir($path)) {
                if ($file === false) {
                    $model->path = null;
                } else {
                    $file->saveAs($path . $model->path);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'clients' => $clients,
                'status' => $status,
            ]);
        }
    }

    /**
     * Updates an existing Contract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = Helpers::getStatus();
        $clients = ArrayHelper::map(Client::find()->orderBy('name')->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $file = $model->uploadContractFile();

            $path = $model->getContractFile($model->id);

            if (Helpers::makDir($path)) {
                if ($file === false) {
                    $model->path = null;
                } else {
                    $file->saveAs($path . $model->path);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'clients' => $clients,
                'status' => $status,
            ]);
        }
    }

    /**
     * Deletes an existing Contract model.
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
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
