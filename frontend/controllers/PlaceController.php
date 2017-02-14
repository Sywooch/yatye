<?php

namespace frontend\controllers;


use backend\models\PlaceService;
use backend\models\WorkingHours;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use backend\models\Contact;
use backend\models\Gallery;
use backend\models\SocialMedia;
use common\helpers\Helpers;
use common\models\District;
use frontend\models\Place;
use backend\components\AdminController;
/**
 * PlaceController implements the CRUD actions for Place model.
 */
class PlaceController extends AdminController
{
    /**
     * Lists all Place models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Place::find()
                ->where(['created_by' => Yii::$app->user->identity->id])
//                ->andWhere(['!=', 'status', Yii::$app->params['active']])
                ->andWhere('`status` = ' . Yii::$app->params['pending'] . ' OR `status` = ' . Yii::$app->params['rejected'] . ' OR `status` = ' . Yii::$app->params['imported'])
                ->orderBy(new Expression('created_at DESC')),
        ]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Place model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $slug = null)
    {
        $model = $this->findModel($id);

        if ($model->slug == $slug && ($model->status != Yii::$app->params['active']) || $model->hasUser()) :

            $places = ArrayHelper::map(Place::find()
                ->where(['!=', 'status', Yii::$app->params['active']])
                ->andWhere(['created_by' => Yii::$app->user->identity->id])
                ->orderBy('id')
                ->limit(10)
                ->all(), 'id', 'name');

            $status = Helpers::getStatus();

            /*Galleries*/
            $gallery_modal = new  Gallery();
            $gallery = Gallery::find()->where(['place_id' => $id])->all();


            /*Contacts*/
            $contact_types = Helpers::getContactTypes();
            $contacts = [new Contact()];
            $contactDataProvider = new ActiveDataProvider([
                'query' => Contact::find()->where(['place_id' => $id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            /*Socials*/
            $social_types = Helpers::getSocialTypes();
            $socials = [new SocialMedia()];
            $socialDataProvider = new ActiveDataProvider([
                'query' => SocialMedia::find()->where(['place_id' => $id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            /*Services*/
            $place_service = new PlaceService();
            $available_services = PlaceService::getNotPlaceServices($id);
            $serviceDataProvider = new ArrayDataProvider([
                'allModels' => $model->getServices(),
                'sort' => [
                    'attributes' => ['category_name', 'name'],
                ],
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            $working_hours = WorkingHours::find()->where(['place_id' => $id])->orderBy('id')->indexBy('id')->all();

            return $this->render('view', [
                'model' => $model,
                'status' => $status,
                'place_id' => $id,
                'slug' => $model->slug,

                'places' => $places,

                /*Contacts*/
                'contactDataProvider' => $contactDataProvider,
                'contact_types' => $contact_types,
                'contacts' => $contacts,

                /*Socials*/
                'socialDataProvider' => $socialDataProvider,
                'social_types' => $social_types,
                'socials' => $socials,

                /*Galleries*/
                'gallery_modal' => $gallery_modal,
                'gallery' => $gallery,

                /*Services*/
                'place_service' => $place_service,
                'available_services' => $available_services,
                'serviceDataProvider' => $serviceDataProvider,

                'working_hours' => $working_hours,
            ]);
        else:
            return $this->redirect(Yii::$app->request->baseUrl . '/place');
        endif;
    }

    /**
     * Creates a new Place model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Place();
        $POST_VARIABLE = Yii::$app->request->post('Place');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $district = District::findOne($POST_VARIABLE['district_id']);
            $model->province_id = $district->province_id;
            $model->status = Yii::$app->params['pending'];
            $model->save(0);

            $model->generateCodes($model);
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Successfully created {modelClass}: ', ['modelClass' => 'place']) . ' ' . $model->name);

            $url = Url::toRoute('place/' . $model->id . '/' . $model->slug);
            return $this->redirect($url);
        } else {
            $districts = ArrayHelper::map(District::find()->orderBy('name')->all(), 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                'districts' => $districts,
            ]);
        }
    }

    /**
     * Updates an existing Place model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->status != Yii::$app->params['active'] || $model->hasUser()) {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $POST_VARIABLE = Yii::$app->request->post('Place');
                if (isset($POST_VARIABLE['district_id']) && $POST_VARIABLE['district_id'] != null) {
                    $district = District::findOne($POST_VARIABLE['district_id']);
                    $model->province_id = $district->province_id;
                }
                $model->save(0);

                $url = Url::toRoute('place/' . $model->id . '/' . $model->slug);
                return $this->redirect($url);

            } else {
                $districts = ArrayHelper::map(District::find()->orderBy('name')->all(), 'id', 'name');
                return $this->render('update', [
                    'model' => $model,
                    'districts' => $districts,
                ]);
            }
        } else {
            return $this->redirect(Yii::$app->request->baseUrl . '/place');
        }

    }

    /**
     * Deletes an existing Place model.
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
     * Finds the Place model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Place the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Place::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
