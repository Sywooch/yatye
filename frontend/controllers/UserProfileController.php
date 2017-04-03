<?php

namespace frontend\controllers;

use Yii;
use yii\web\UploadedFile;
use frontend\models\UserProfile;
use common\helpers\RecordHelpers;
use yii\web\NotFoundHttpException;
use backend\components\AdminController;

/**
 * UserProfileController implements the CRUD actions for UserProfile model.
 */
class UserProfileController extends AdminController
{

    /**
     * Lists all UserProfile models.
     * @return mixed
     */
    public function actionIndex()
    {

        if ($already_exists = RecordHelpers::userHas('user_profile')) {

            return $this->render('update', [

                'model' => $this->findModel($already_exists),
            ]);

        } else {

            return $this->redirect(['create']);

        }

    }

    /**
     * Displays a single UserProfile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);

        if ($already_exists = RecordHelpers::userHas('user_profile')) {

            return $this->render('view', [

                'model' => $this->findModel($already_exists),
            ]);

        } else {

            return $this->redirect(['create']);

        }
    }

    /**
     * Creates a new UserProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserProfile();

        $model->user_id = Yii::$app->user->identity->id;


        $POST_VARIABLE = Yii::$app->request->post('Place');
        echo $POST_VARIABLE['first_name'];

        if ($already_exists = RecordHelpers::userHas('user_profile')) {
            return $this->render('view', [

                'model' => $this->findModel($already_exists),
            ]);

        } elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Profile successfully created!'));
            return $this->redirect(['view']);

        } else {
//            echo $model->user_id;
            return $this->render('create', [

                'model' => $model,

            ]);
        }

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Updates an existing UserProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateUser()
    {


        if ($model = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view']);

            } else {

                return $this->render('update', [

                    'model' => $model,

                ]);
            }

        } else {

            return $this->redirect(['create']);

        }


//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Deletes an existing UserProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);

        $model = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();

        $this->findModel($model->id)->delete();
        $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['profile'] . $model->avatar;
        try {
            unlink($path);
        } catch (\Exception $e) {
            //error
        }

        return $this->redirect(['create']);
    }

    /**
     * Finds the UserProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionProfilePicture()
    {

        if ($already_exists = RecordHelpers::userHas('user_profile')) {

            if ($model = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one()) {

                try {
                    if (Yii::$app->request->isPost) {
                        if ($model->image = UploadedFile::getInstance($model, 'image')) {

                            $file_name = $model->first_name . '_' . $model->last_name . '_' . rand() . rand() . date("Ymdhis") . '.' . $model->image->extension;
                            $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['profile'] . $file_name;

                            $file_name = preg_replace('/\s+/', '', $file_name);
                            $model->avatar = $file_name;
                            $model->save();
                            $model->image->saveAs($path);

//                        if(Helpers::resizeBeforeUpload($model->image->tempName, $path, 230, 230)){
//                            $model->avatar = $file_name;
//                            $model->save();
//                        }
                        }
                        Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Profile picture successfully uploaded!'));
                        return $this->redirect('view');
                    }
                } catch (\Exception $e) {
                    //error
                }
            }

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Please create your profile first!'));
            return $this->redirect(['create']);

        }
    }


}
