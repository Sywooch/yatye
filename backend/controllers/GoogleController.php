<?php

namespace backend\controllers;


use common\helpers\GoogleHelpers;
use Yii;
use backend\models\GooglePlaces;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use backend\components\BaseEventController;

/**
 * GoogleController implements the CRUD actions for GooglePlaces model.
 */
class GoogleController extends BaseEventController
{

    /**
     * Lists all GooglePlaces models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GooglePlaces::find()
                ->where(['status' => Yii::$app->params['inactive']])
                ->orderBy(new Expression('created_at DESC')),
        ]);
        $model = new GooglePlaces();
        $types = GoogleHelpers::getPlaceTypes();

        return $this->render('index', [
            'model' => $model,
            'types' => $types,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GooglePlaces model.
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
     * Creates a new GooglePlaces model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GooglePlaces();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GooglePlaces model.
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

    public function actionDelete()
    {
        GooglePlaces::deleteAll(['status' => Yii::$app->params['inactive']]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the GooglePlaces model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GooglePlaces the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GooglePlaces::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport()
    {
        $post = Yii::$app->request->post('GooglePlaces');
        if (Yii::$app->request->isPost) {

            if ($post['next_page_token'] != '') {
                $search_url = Yii::$app->params['google']['url']
                    . '?location=' . $post['location']
                    . '&radius=' . $post['radius']
                    . '&type=' . $post['type']
                    . '&key=' . Yii::$app->params['google']['key']
                    . '&pagetoken=' . $post['next_page_token'];
            } else {
                $search_url = Yii::$app->params['google']['url']
                    . '?location=' . $post['location']
                    . '&radius=' . $post['radius']
                    . '&type=' . $post['type']
                    . '&key=' . Yii::$app->params['google']['key'];
            }

            $json = file_get_contents($search_url);
            $places = json_decode($json, true);
            GooglePlaces::importEvents($places);

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Google Places successfully saved!'));
        }

        return $this->redirect(Url::to(['index']));
    }

    public function actionSave($id)
    {
        $model = $this->findModel($id);

        if ($model->saveGooglePlaces()) {
            $model->status = Yii::$app->params['accepted'];
            $model->save();
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Google Places successfully imported!'));
        }
        return $this->redirect(Url::to(['index']));
    }

}
