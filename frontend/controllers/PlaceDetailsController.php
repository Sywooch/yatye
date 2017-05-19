<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use frontend\models\Place;
use frontend\models\Views;
use frontend\models\Review;
use frontend\models\Enquiry;
use frontend\models\Ratings;
use common\helpers\EmailHelper;
use frontend\models\ContactForm;
use common\helpers\MetaTagHelpers;
use backend\models\place\Subscription;
use backend\components\AdminController;

class PlaceDetailsController extends AdminController
{
    public function actionIndex()
    {
        return $this->redirect(Yii::$app->params['root']);
    }

    public function actionSlug($slug)
    {
        $model = Place::findOne(['slug' => $slug, 'status' => Yii::$app->params['active']]);

        if ($model) {
            $title = $model->name;
            $description = $model->description;
            $image = $model->getPhoto();
            $url = 'http://rwandaguide.info/place-details//' . $model->slug;
            MetaTagHelpers::registerMetaTag($title, $description, $image, $url);

            Views::insertViews($model->id);

            $views = $model->getViews();
            $photos = $model->getPhotos();
            $working_hours = $model->getHours();
            $socials = $model->getSocials();
            $amenities = $model->getAmenities();
            $all_amenities = $model->getAllAmenities();
            $contacts = $model->getContacts();

            $ratings = new Ratings();
            $contact_form = new ContactForm();
            $review = new Review();

            $query = Review::find()->where(['place_id' => $model->id]);

            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);

            $comments = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();


            $related_place_ids = $model->getRelatedPlaceIds();
            $related_places = $model->getRelatedPlaces()->all();
            $other_places = ($model->getNearByPlaces() != null) ? $model->getNearByPlaces()->all() : null;

            $nearByPlacesDataProvider = new ActiveDataProvider([
                'query' => $model->getNearByPlaces(),
            ]);

            $relatedPlacesDataProvider = new ActiveDataProvider([
                'query' => $model->getRelatedPlaces(),
            ]);

            return $this->render('index', [
                'model' => $model,
                'nearByPlacesDataProvider' => $nearByPlacesDataProvider,
                'relatedPlacesDataProvider' => $relatedPlacesDataProvider,
                'photos' => $photos,
                'working_hours' => $working_hours,
                'socials' => $socials,
                'amenities' => $amenities,
                'all_amenities' => $all_amenities,
                'ratings' => $ratings,
                'place_id' => $model->id,
                'contacts' => $contacts,
                'contact_form' => $contact_form,
                'review' => $review,
                'comments' => $comments,
                'pagination' => $pagination,
                'related_place_ids' => $related_place_ids,
                'related_places' => $related_places,
                'other_places' => $other_places,
                'views' => $views,
            ]);

        } else {
            return $this->redirect(Yii::$app->params['root']);
        }
    }

    public function actionContact()
    {
        $id = Yii::$app->request->get('id');

        $contact_form = new ContactForm();

        $model = Place::findOne(['id' => $id]);

        $emails = $model->getContact(Yii::$app->params['EMAIL']);

        if ($contact_form->load(Yii::$app->request->post()) && !empty($emails)) :

            foreach ($emails as $email) :
                if (EmailHelper::validEmail($email->name)){
                    $send_email = EmailHelper::sendEnquiryEmail($model->name, $email->name, $contact_form);
                }

                Enquiry::saveEnquiry($id, $contact_form);
                Subscription::saveUserToSubscription($contact_form->email);

            endforeach;

            if ($send_email) :

                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            else:
                Yii::$app->session->setFlash('fail', 'There was an error sending email.');
            endif;

            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $model->slug);
        else:
            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $model->slug);
        endif;
    }

    public function actionComment()
    {
        $id = Yii::$app->request->get('id');

        $place = Place::findOne(['id' => $id]);

        $model = new Review();

        if ($model->load(Yii::$app->request->post())) {

            $model->place_id = $id;
            $model->status = Yii::$app->params['active'];
            $model->ip_address = Yii::$app->request->getUserIP();
            $model->save(0);

            Yii::$app->session->setFlash('success', 'Thank you for your review!');

            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
        } else {
            Yii::$app->session->setFlash('fail', 'There was an error while submitting your review!');

            return $this->redirect(Yii::$app->request->baseUrl . '/place-details/' . $place->slug);
        }
    }
}
