<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/06/2016
 * Time: 19:23
 */

namespace backend\components;

use backend\models\EventTags;
use backend\models\post\Post;
use backend\models\post\PostCategory;
use Yii;
use yii\base\Model;
use backend\models\Blog;
use backend\models\Event;
use yii\web\UploadedFile;
use frontend\models\Views;
use backend\models\place\Place;
use backend\models\place\Gallery;
use backend\models\place\Contact;
use backend\models\place\Service;
use common\helpers\GalleryHelper;
use common\helpers\RecordHelpers;
use backend\models\place\Category;
use backend\models\place\UserPlace;
use backend\models\place\SocialMedia;
use backend\models\place\WorkingHours;
use backend\models\place\PlaceService;
use common\components\AdminController;

class BaseController extends AdminController
{
    public function actions()
    {
        return ['image-upload' => [

            'class' => 'vova07\imperavi\actions\UploadAction',

            // Directory URL address, where files are stored.
            'url' => Yii::$app->params['blog_images'],

            // Or absolute path to directory where files are stored.
            'path' => Yii::$app->params['frontend_alias'] . Yii::$app->params['blog']],
        ];
    }

    public function actionStatus()
    {
        $model = null;

        if (Yii::$app->controller->id == 'place') :
            $model = Place::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'views') :
            $model = Views::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'post') :
            $model = Post::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'blog') :
            $model = Blog::findOne(Yii::$app->request->get('id'));
        endif;
        if (Yii::$app->controller->id == 'post-category') :
            $model = PostCategory::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'category') :
            $model = Category::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'service') :
            $model = Service::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'event') :
            $model = Event::findOne(Yii::$app->request->get('id'));
        endif;

        if (Yii::$app->controller->id == 'event-tags') :
            $model = EventTags::findOne(Yii::$app->request->get('id'));
        endif;



        if (!is_null ($model)) :
            RecordHelpers::status($model);

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Status changed successfully!'));
            return $this->redirect(Yii::$app->request->baseUrl . '/' . Yii::$app->controller->id);
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Status did not changed! Try again'));
            return $this->redirect(Yii::$app->request->baseUrl . '/' . Yii::$app->controller->id);
        endif;

    }

    public function actionActivateLogo()
    {
        $model = Gallery::findOne(Yii::$app->request->get('id'));

        $place_id = Yii::$app->request->get('place_id');
        $place = Place::findOne($place_id);
        $url = $this->getUrl($place_id);

        if (!is_null ($model)) :
            RecordHelpers::logo($model, $place);

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Logo is set successfully!'));
            return $this->redirect($url);
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Logo did not set! Try again'));
            return $this->redirect($url);
        endif;
    }

    public function actionSetGallery()
    {
        $place_id = Yii::$app->request->get('place_id');
        $gallery = new Gallery();
        $gallery->scenario = 'create';

        $place = Place::findOne($place_id);
        $place->generateCodes($place);
        $url = $this->getUrl($place_id);

        try {
            if (Yii::$app->request->isPost) {

                if ($gallery->image = UploadedFile::getInstances($gallery, 'image')) {
                    $counter = 0;
                    foreach ($gallery->image as $file) {
                        $counter++;
                        $model = new Gallery();
                        $file_name = $place->code . '_' . rand() . rand() . date("Ymdhis") . '_' . $counter . '.' . $file->extension;
                        $model->uploadAndSaveImages($file, $file_name, $place_id);
                    }
                }

                Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Gallery successfully added.'));
                return $this->redirect($url);
            } else {
                Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Gallery not added.'));
                return $this->redirect($url);
            }
        } catch (\Exception $e) {
            //error
        }

    }

    public function actionDeleteGallery()
    {
        $place_id = Yii::$app->request->get('place_id');
        $url = $this->getUrl($place_id);

        $id = Yii::$app->request->get('gallery_id');
        $model = Gallery::findOne($id);
        $model->delete();

        $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['gallery'] . $model->name;
        $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['thumbnail'] . 'tn_' . $model->name;
        $tn_thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['tn_thumbnail'] . 'tn_tn_' . $model->name;

        GalleryHelper::deleteGallery($path);
        GalleryHelper::deleteGallery($thumbnail_path);
        GalleryHelper::deleteGallery($tn_thumbnail_path);

        Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Gallery successfully deleted.'));
        return $this->redirect($url);
    }

    public function actionAddServices()
    {
        $place_id = Yii::$app->request->get('place_id');
        $POST_VARIABLE = Yii::$app->request->post('PlaceService');
        $url = $this->getUrl($place_id);

        if (Yii::$app->request->isPost) {
            foreach ($POST_VARIABLE['service_id'] as $key => $service_id) {
                $model = new PlaceService();
                RecordHelpers::saveModelHasData($model, 'place_id', 'service_id', $place_id, $service_id);
            }

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Services successfully added.'));
            return $this->redirect($url);
        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Services are not added.'));
            return $this->redirect($url);
        }
    }

    public function actionAddContacts()
    {
        $place_id = Yii::$app->request->get('place_id');
        $url = $this->getUrl($place_id);

        $count = count(Yii::$app->request->post('Contact', []));
        $contacts = [new Contact()];

        for($i = 1; $i < $count; $i++) {
            $contacts[] = new Contact();
        }

        $post = Yii::$app->request->post('Contact');
        if (Model::loadMultiple($contacts, Yii::$app->request->post())) {
            $j = 0;
            foreach ($contacts as $contact) {
                $contact->place_id = $place_id;
                $contact->type = $post[$j]['type'];
                $contact->name = $post[$j]['name'];
                $contact->status = Yii::$app->params['active'];
                $contact->save(0);
                $j++;
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Contacts successfully added.'));
            return $this->redirect($url);

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Contacts are not added.'));
            return $this->redirect($url);
        }
    }

    public function actionAddSocialMedia()
    {
        $place_id = Yii::$app->request->get('place_id');
        $url = $this->getUrl($place_id);

        $count = count(Yii::$app->request->post('SocialMedia', []));
        $socials = [new SocialMedia()];
        for($i = 1; $i < $count; $i++) {
            $socials[] = new SocialMedia();
        }

        $post = Yii::$app->request->post('SocialMedia');
        if (Model::loadMultiple($socials, Yii::$app->request->post())) {
            $j = 0;
            foreach ($socials as $social) {
                $social->place_id = $place_id;
                $social->type = $post[$j]['type'];
                $social->name = $post[$j]['name'];
                $social->status = Yii::$app->params['active'];
                $social->save(0);
                $j++;
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Social media is set successfully!'));
            return $this->redirect($url);

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Social media did not set! Try again'));
            return $this->redirect($url);
        }
    }

    public function actionSetWorkingHours(){

        $place_id = Yii::$app->request->get('place_id');
        $url = $this->getUrl($place_id);

        $working_hours = WorkingHours::find()->where(['place_id' => $place_id])->orderBy('id')->indexBy('id')->all();

        if (Model::loadMultiple($working_hours, Yii::$app->request->post())) {
            foreach ($working_hours as $working_hour) {
                $working_hour->status = Yii::$app->params['active'];
                $working_hour->save(0);
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Working Hours successfully added.'));
            return $this->redirect($url);

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Working Hours are not added.'));
            return $this->redirect($url);
        }
    }

    public function actionDeleteItem()
    {
        $place_id = Yii::$app->request->get('place_id');
        $url = $this->getUrl($place_id);

        $service_id = Yii::$app->request->get('service_id');
        $contact_id = Yii::$app->request->get('contact_id');
        $social_id = Yii::$app->request->get('social_id');
        $user_id = Yii::$app->request->get('user_id');

        $model = null;

        if ($service_id) :
            $model = PlaceService::findOne(['place_id' => $place_id, 'service_id' => $service_id]);
        endif;

        if ($contact_id) :
            $model = Contact::findOne(['place_id' => $place_id, 'id' => $contact_id]);
        endif;

        if ($social_id) :
            $model = SocialMedia::findOne(['place_id' => $place_id, 'id' => $social_id]);
        endif;

        if ($user_id) :
            $model = UserPlace::findOne(['place_id' => $place_id, 'user_id' => $user_id]);
        endif;

        if (!is_null ($model)) :
            RecordHelpers::deleteOneRecord($model);
            return $this->redirect($url);
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'There is an error! Please try again'));
            return $this->redirect($url);
        endif;
    }

}