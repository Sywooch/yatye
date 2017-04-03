<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use backend\helpers\Helpers;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelpers;
use backend\models\place\Place;
use yii\data\ActiveDataProvider;
use backend\models\place\Gallery;
use backend\models\place\Service;
use backend\models\place\Category;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends BackendAdminController
{
    /**
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $place_id = Yii::$app->request->get('place_id');

        $query = Gallery::find();

        $dataProvider = new ActiveDataProvider([
            'query' => (!$place_id) ? $query : $query->where(['place_id' => $place_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $categories = ArrayHelper::map(Category::find()->orderBy('name')->all(), 'id', 'name');
        $status = Helpers::getStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'place_id' => $model->place_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'status' => $status,
            ]);
        }
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGallery()
    {
        $place_id = Yii::$app->request->get('place_id');
        $place = Place::findOne($place_id);
        $model = new Gallery();

        $galleries = Gallery::find()->where(['place_id' => $place_id])->orderBy('id')->indexBy('id')->all();
        $categories = ArrayHelper::map(Category::find()->orderBy('name')->all(), 'id', 'name');
//        $services = ArrayHelper::map(Service::find()->where(['status' => Yii::$app->params['active']])->orderBy('name')->all(), 'id', 'name');
        $services = ArrayHelper::map(Service::find()->where(['status' => Yii::$app->params['active']])->all(), 'id', 'name');

        $places = DataHelpers::getPlacesInArray1();
        $count = Place::findAll(['status' => Yii::$app->params['active'], 'main' => 0]);

        if (Model::loadMultiple($galleries, Yii::$app->request->post())) {
            foreach ($galleries as $gallery) {
                $gallery->place_id = $place_id;
                $gallery->title = $place->name;
                $gallery->caption = $place->name;
                $gallery->status = Yii::$app->params['active'];
                $gallery->save(0);

            }
            $place->main = 1;
            $place->save(0);

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Contacts successfully added.'));
            return $this->redirect(Url::to(['gallery/gallery', 'place_id' => $place_id]));

        } else {
            return $this->render('gallery', [
                'model' => $model,
                'galleries' => $galleries,
                'services' => $services,
                'categories' => $categories,
                'place_id' => $place_id,
                'places' => $places,
                'place' => $place,
                'count' => $count,
            ]);
        }
    }

}
