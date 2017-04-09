<?php

namespace backend\controllers;

use backend\models\Event;
use Yii;
use backend\models\FacebookEvents;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use backend\components\BaseEventController;

/**
 * FacebookController implements the CRUD actions for FacebookEvents model.
 */
class FacebookController extends BaseEventController
{

    /**
     * Lists all FacebookEvents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FacebookEvents::find()
                ->where(['status' => Yii::$app->params['inactive']])
                ->orderBy(new Expression('created_at DESC')),
        ]);

        $model = new FacebookEvents();

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FacebookEvents model.
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
     * Updates an existing FacebookEvents model.
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
     * Deletes an existing FacebookEvents model.
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
     * Finds the FacebookEvents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FacebookEvents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FacebookEvents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport()
    {
        $post = Yii::$app->request->post('FacebookEvents');
        if (Yii::$app->request->isPost){
            $search_url = Yii::$app->params['facebook']['url'] . $post['endpoints'] . '&access_token=' . $post['access_token'];
            $json = file_get_contents($search_url);
            $events = json_decode($json, true);
            FacebookEvents::importEvents($events['data']);
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Facebook Events successfully saved!'));
        }

        return $this->redirect(Url::to(['index']));
    }

    public function actionSave($id)
    {
        $model = $this->findModel($id);

        if($model->saveFacebookEvents()){
            $model->status = Yii::$app->params['accepted'];
            $model->save();
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Facebook Events successfully imported!'));
        }
        return $this->redirect(Url::to(['index']));
    }
}
