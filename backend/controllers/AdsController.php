<?php

namespace backend\controllers;

use Yii;
use backend\models\Ads;
use yii\web\UploadedFile;
use common\helpers\Helpers;
use yii\data\ActiveDataProvider;
use common\helpers\GalleryHelper;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * AdsController implements the CRUD actions for Ads model.
 */
class AdsController extends BackendAdminController
{
    /**
     * Lists all Ads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ads::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ads model.
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
     * Creates a new Ads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ads();
        $model->scenario = 'create';
        $params = $model->getParams();


        if ($model->load(Yii::$app->request->post())) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            //list($width, $height) = getimagesize($model->image_file->tempName);
            $file_name = rand() . rand() . date("Ymdhis") . '.' . $model->image_file->extension;
            $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['ads'] . $file_name;
            $file_name = preg_replace('/\s+/', '', $file_name);

            $image_size = $model->checkImageSizes();
            if (GalleryHelper::uploadAds($model->image_file->tempName, $path, $image_size['width'], $image_size['height'])) {
                $model->image = $file_name;
                $model->save(0);
                return $this->redirect(['index']);
            }
            else{
                return $this->render('create', $params);
            }

        } else {
            return $this->render('create', $params);
        }
    }

    /**
     * Updates an existing Ads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $params = $model->getParams();

        if ($model->load(Yii::$app->request->post())) {

            $model->image_file = UploadedFile::getInstance($model, 'image_file');

            if ($model->image_file){
                $file_name = rand() . rand() . date("Ymdhis") . '.' . $model->image_file->extension;
                $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['ads'] . $file_name;
                $file_name = preg_replace('/\s+/', '', $file_name);

                $image_size = $model->checkImageSizes($model);
                if (GalleryHelper::uploadAds($model->image_file->tempName, $path, $image_size['width'], $image_size['height'])) {
                    $model->image = $file_name;
                }
                else{
                    return $this->render('update', $params);
                }
            }

            $model->save();
            return $this->redirect(['index']);

        } else {
            return $this->render('update', $params);
        }
    }

    /**
     * Deletes an existing Ads model.
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
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
