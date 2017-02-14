<?php

namespace backend\controllers;

use Yii;
use backend\models\NewsLetter;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;

/**
 * NewsLetterController implements the CRUD actions for NewsLetter model.
 */
class NewsLetterController extends BackendAdminController
{

    /**
     * Lists all NewsLetter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => NewsLetter::find()->orderBy(new Expression('created_at DESC')),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsLetter model.
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
     * Creates a new NewsLetter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsLetter();

        $types = array_combine(['users', 'places', 'visitors', 'all'], [
            Yii::t('app', 'Users'),
            Yii::t('app', 'Places'),
            Yii::t('app', 'Visitors'),
            Yii::t('app', 'All'),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Newsletter saved successfully!'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'types' => $types,
            ]);
        }
    }

    /**
     * Updates an existing NewsLetter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $types = array_combine(['users', 'places', 'visitors', 'all'], [
            Yii::t('app', 'Users'),
            Yii::t('app', 'Places'),
            Yii::t('app', 'Visitors'),
            Yii::t('app', 'All'),
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Newsletter updated successfully!'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'types' => $types,
            ]);
        }
    }

    /**
     * Deletes an existing NewsLetter model.
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
     * Finds the NewsLetter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsLetter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsLetter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSend($id)
    {
        $this->findModel($id)->sendNewsLetter();
        Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Newsletter sent successfully!'));
        return $this->redirect(['index']);
    }
}
