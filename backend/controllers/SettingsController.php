<?php

namespace backend\controllers;

use backend\models\PlaceHasAnother;
use backend\models\PlaceService;
use backend\models\WorkingHours;
use common\helpers\DataHelpers;
use Yii;
use backend\models\Place;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use backend\models\Category;
use backend\models\Contact;
use backend\models\Gallery;
use backend\models\SocialMedia;
use backend\models\UserPlace;
use common\models\District;
use common\helpers\Helpers;
use common\models\User;

use backend\components\AdminController as BackendAdminController;

class SettingsController extends BackendAdminController
{
    public function actionIndex()
    {
        $place_id = Yii::$app->request->get('id');
        $model = $this->findModel($place_id);
        $model->generateCodes($model);

        $status = Helpers::getStatus();
        $profile_types = Helpers::getProfileType();
        $districts = ArrayHelper::map(District::find()->orderBy('name')->all(), 'id', 'name');
        $categories = Category::find()->where(['status' => Yii::$app->params['active']]);


        /*Working Hours*/
        $working_hours = WorkingHours::find()->where(['place_id' => $place_id])->orderBy('id')->indexBy('id')->all();

        /*User*/
        $user_place = new UserPlace();
        $users = UserPlace::getUsers($place_id);
        $userDataProvider = new ArrayDataProvider([
            'allModels' => $model->getPlaceUsers(),
            'sort' => [
                'attributes' => ['email'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Places*/
        $place_has_another = new PlaceHasAnother();
        $places = DataHelpers::getPlacesInArray();
        $available_other_places = PlaceHasAnother::getAvailableOtherPlaces($place_id);

        $all_places = Place::find()->all();
        /*Galleries*/
        $gallery_modal = new  Gallery();
        $gallery = Gallery::find()->where(['place_id' => $place_id])->all();


        /*Contacts*/
        $contact_types = Helpers::getContactTypes();
        $contacts = [new Contact()];
        $contactDataProvider = new ActiveDataProvider([
            'query' => Contact::find()->where(['place_id' => $place_id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Socials*/
        $social_types = Helpers::getSocialTypes();
        $socials = [new SocialMedia()];
        $socialDataProvider = new ActiveDataProvider([
            'query' => SocialMedia::find()->where(['place_id' => $place_id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Services*/
        $place_service = new PlaceService();
        $available_services = PlaceService::getNotPlaceServices($place_id);
        $serviceDataProvider = new ArrayDataProvider([
            'allModels' => $model->getServices(),
            'sort' => [
                'attributes' => ['category_name', 'name'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        return $this->render('index', [
            'model' => $model,
            'status' => $status,
            'districts' => $districts,
            'place_id' => $place_id,
            'categories' => $categories,

            /*Places*/
            'places' => $places,
            'profile_types' => $profile_types,
            'all_places' => $all_places,
            'place_has_another' => $place_has_another,
            'available_other_places' => $available_other_places,

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

            /*User*/
            'userDataProvider' => $userDataProvider,
            'user_place' => $user_place,
            'users' => $users,

            /*Working Hours*/
            'working_hours' => $working_hours,
        ]);
    }
}
