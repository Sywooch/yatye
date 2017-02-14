<?php

namespace backend\controllers;

use Yii;
use backend\models\UploadForm;
use yii\helpers\Url;
use yii\web\UploadedFile;
use backend\components\AdminController as BackendAdminController;

class ImportPlacesController extends BackendAdminController
{
    public function actionIndex()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');

            if ($model->upload()) {

                $inputFile = Yii::$app->basePath . '/web/imports/' . $model->uploadedFile->baseName . '.' . $model->uploadedFile->extension;

                if ($model->importExcel($inputFile)) {
                    Yii::$app->session->setFlash('success', "Places imported successfully!");
                }
                return $this->redirect(Url::to(['/place']));
            } else {

                Yii::$app->session->setFlash('flashError', "There is a problem while uploading file! Please verify your file and upload it again or Contact the administrator for supporting");
                return $this->redirect(Url::to(['/place']));
            }
        }

        return $this->render('index', [
            'uploadForm' => $model,
        ]);
    }

}
