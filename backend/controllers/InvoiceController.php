<?php

namespace backend\controllers;

use backend\models\Client;
use backend\models\InvoiceItem;
use common\helpers\Helpers;
use Yii;
use backend\models\Invoice;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends BackendAdminController
{
    /**
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Invoice::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
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
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoice();
        $status = Helpers::getStatus();
        $clients = ArrayHelper::map(Client::find()->orderBy('name')->all(), 'id', 'name');


        $count = count(Yii::$app->request->post('InvoiceItem', []));
        $invoice_items = [new InvoiceItem()];

        for ($i = 1; $i < $count; $i++) {
            $invoice_items[] = new InvoiceItem();
        }
        $post = Yii::$app->request->post('InvoiceItem');

        if ($model->load(Yii::$app->request->post())) {

            $transaction = $model->getDb()->beginTransaction();
            try {
                $model->save();
                $model->saveInvoiceItems($post, $invoice_items);
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'status' => $status,
                'clients' => $clients,
                'invoice_items' => $invoice_items,
            ]);
        }
    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = Helpers::getStatus();
        $clients = ArrayHelper::map(Client::find()->orderBy('name')->all(), 'id', 'name');
        $invoice_items = $model->getInvoiceItems();

        $post = Yii::$app->request->post('InvoiceItem');
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                $model->save();
                $model->saveInvoiceItems($post, $invoice_items);
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'status' => $status,
                'clients' => $clients,
                'invoice_items' => $invoice_items,
            ]);
        }
    }

    /**
     * Deletes an existing Invoice model.
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
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
