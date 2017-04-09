<?php

namespace backend\controllers;

use Yii;
use yii\db\Expression;
use backend\models\Event;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use common\helpers\GalleryHelper;
use yii\web\NotFoundHttpException;
use backend\components\BaseEventController;


/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends BaseEventController
{

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()
//                ->where(new Expression('`start_date` >= CURRENT_TIMESTAMP'))
                ->orderBy(new Expression('`created_at` DESC')),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
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
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $params = $model->getParameters();

        $session = Yii::$app->session;
        $session->set('event_id', $model->id);

        if ($model->load(Yii::$app->request->post())) {

            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            $old_image = $model->getPath() . $model->banner;

            if ($model->image_file){
                $file_name = rand() . rand() . date("Ymdhis") . '.' . $model->image_file->extension;
                $thumbnail_file_name = 'tn_' . $file_name;

                $path = $model->getPath() . $file_name;
                $thumbnail_path = $model->getThumbnailPath() . $thumbnail_file_name;

                $file_name = preg_replace('/\s+/', '', $file_name);

                if (GalleryHelper::uploadEvents($model->image_file->tempName, $path)) {

                    //Save thumbnails
                    GalleryHelper::resizeBeforeUpload($model->image_file->tempName, $thumbnail_path, 180, 150, 120);
                    $model->banner = $file_name;

                    //Delete Existing Image
                    GalleryHelper::deleteGallery($old_image);
                }
                else{
                    return $this->render('update', $params);
                }
            }
            $model->save(0);
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', $params);
        }
    }

    /**
     * Deletes an existing Event model.
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
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
