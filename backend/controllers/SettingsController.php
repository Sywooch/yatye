<?php

namespace backend\controllers;

use Yii;
use common\helpers\Helpers;
use common\models\District;
use yii\helpers\ArrayHelper;
use backend\models\place\Place;
use common\helpers\DataHelpers;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use backend\models\place\Contact;
use backend\models\place\Gallery;
use backend\models\place\Category;
use backend\models\place\UserPlace;
use backend\models\place\SocialMedia;
use backend\models\place\PlaceHasService;
use backend\models\place\WorkingHours;
use backend\models\place\PlaceHasAnother;
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
        $place_has_service = new PlaceHasService();
        $available_services = PlaceHasService::getNotPlaceHasServices($place_id);
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
            'place_has_service' => $place_has_service,
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
