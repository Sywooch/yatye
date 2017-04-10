<?php

namespace backend\controllers;

use backend\helpers\Helpers;
use Yii;
use yii\db\Expression;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use backend\models\post\Post;
use yii\data\ActiveDataProvider;
use backend\models\place\Gallery;
use backend\models\post\PostType;
use yii\web\NotFoundHttpException;
use backend\models\post\SearchPost;
use backend\components\AdminController as BackendAdminController;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends BackendAdminController
{

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPost();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $status = Helpers::getStatus();
        $post_types =  ArrayHelper::map(PostType::find()
            ->where(['status' => Yii::$app->params['active']])
            ->all(), 'id', 'name');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'status' => $status,
            'post_types' => $post_types,
        ]);
    }

    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $post_types = ArrayHelper::map(PostType::find()->orderBy('name')->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'post_types' => $post_types,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $post_types = ArrayHelper::map(PostType::find()->orderBy('name')->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'post_types' => $post_types,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
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
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPostPicture()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->image_file = UploadedFile::getInstance($model, 'image_file')) {
                $file_name = $model->id . '_' . rand() . rand() . date("Ymdhis") . '.' . $model->image_file->extension;

                $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['post'] . $file_name;

                $thumbnail_file_name = 'tn_' . $file_name;
                $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['post_thumbnail'] . $thumbnail_file_name;

                $file_name = preg_replace('/\s+/', '', $file_name);
//                    $file->saveAs($path);

                $max_width_768 = 768;
                $max_width_180 = 180;

                $min_width_512 = 512;
                $min_width_150 = 150;

                $min_heigth_384 = 384;
                $min_heigth_120 = 120;


                if (Gallery::resizeBeforeUpload($model->image_file->tempName, $path, $max_width_768, $min_width_512, $min_heigth_384)) {

                    //Save thumbnails
                    Gallery::resizeBeforeUpload($model->image_file->tempName, $thumbnail_path, $max_width_180, $min_width_150, $min_heigth_120);
//                    echo $model->image;
                    $model->image = $file_name;
                    $model->save(0);
                }
            }
            return $this->redirect(Yii::$app->request->baseUrl . '/post/view?id=' . $id);
        }
    }

    public function actionDeletePostPicture()
    {

        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);


        $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['post'] . $model->image;
        $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['post_thumbnail'] . 'tn_' . $model->image;
        try {
            unlink($path);
            unlink($thumbnail_path);
        } catch (\Exception $e) {
            //error
        }
        $model->image = '';
        $model->save(0);
        return $this->redirect(Yii::$app->request->baseUrl . '/post/view?id=' . $id);
    }

    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->status = Yii::$app->params['active'];

        if ($model->save(0)) {
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Article published successfully!'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Article not published! Try again'));
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

}
