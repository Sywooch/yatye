<?php

namespace backend\controllers;

use backend\models\PricingHasItem;
use backend\models\PricingItem;
use common\helpers\RecordHelpers;
use Yii;
use backend\models\Pricing;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * PricingController implements the CRUD actions for Pricing model.
 */
class PricingController extends BackendAdminController
{

    /**
     * Lists all Pricing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pricing::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pricing model.
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
     * Creates a new Pricing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pricing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pricing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pricing model.
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
     * Finds the Pricing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pricing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pricing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPublish($id)
    {
        $model = $this->findModel($id);

        if (!is_null($model)) :
            if ($model->status == Yii::$app->params['draft'] || $model->status == Yii::$app->params['unpublish']) :
                $model->status = Yii::$app->params['publish'];
                $model->save(0);
                Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Pricing published successfully!'));
            elseif ($model->status == Yii::$app->params['publish']) :
                $model->status = Yii::$app->params['unpublish'];
                $model->save(0);
                Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Pricing unpublished successfully!'));
            endif;
        endif;

        return $this->redirect(['index']);
    }

    public function actionAddPricingItem1($id)
    {
        $POST_VARIABLE = Yii::$app->request->post('PricingHasItem');
        $pricing_items = PricingHasItem::getNotPricingItems($id);

        if (Yii::$app->request->isPost) {
            foreach ($POST_VARIABLE['pricing_item_id'] as $key => $pricing_item_id) {
                $model = new PricingHasItem();
                RecordHelpers::saveModelHasData($model, 'pricing_id', 'pricing_item_id', $id, $pricing_item_id);
            }

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Pricing items successfully added.'));
            return $this->redirect(['index']);
        } else {
            return $this->render('add_pricing_item', [
                'model' => new PricingHasItem(),
                'models' => [new PricingHasItem()],
                'pricing_items' => $pricing_items,
            ]);
        }


    }

    public function actionAddPricingItem($id)
    {

//        $id = Yii::$app->request->get('id');
        $pricing = $this->findModel($id);
        $pricing_items = PricingHasItem::getNotPricingItems($id);

        $count = count(Yii::$app->request->post('PricingHasItem', []));

        $models = [new PricingHasItem()];

        for ($i = 1; $i < $count; $i++) {
            $models[] = new PricingHasItem();
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $pricing->getPricingItems(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $post = Yii::$app->request->post('PricingHasItem');
        if (Model::loadMultiple($models, Yii::$app->request->post())) {
            $j = 0;
            foreach ($models as $model) {
                $model->pricing_id = $id;
                $model->pricing_item_id = $post[$j]['pricing_item_id'];
                $model->descriptions = $post[$j]['descriptions'];
                $model->save(0);
                $j++;
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Pricing items successfully added.'));
            return $this->redirect(['index']);

        } else {
            return $this->render('add_pricing_item', [
                'model' => new PricingHasItem(),
                'models' => [new PricingHasItem()],
                'pricing_items' => $pricing_items,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionDeleteItem()
    {
        $pricing_id = Yii::$app->request->get('pricing_id');
        $pricing_item_id = Yii::$app->request->get('pricing_item_id');
        $model = PricingHasItem::findOne(['pricing_id' => $pricing_id, 'pricing_item_id' => $pricing_item_id]);
        $model->delete();
        return $this->redirect(['index']);
    }
}
