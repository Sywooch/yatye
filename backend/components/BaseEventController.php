<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/23/17
 * Time: 10:30 PM
 */

namespace backend\components;


use Yii;
use backend\components\AdminController as BackendAdminController;
use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\EventContact;
use backend\models\EventHasTags;
use backend\models\EventSocialMedia;
use backend\models\UserEvent;
use common\helpers\GalleryHelper;
use common\helpers\RecordHelpers;

class BaseEventController extends BackendAdminController
{
    public function actionAddContacts()
    {
        $event_id = Yii::$app->request->get('event_id');
        $count = count(Yii::$app->request->post('EventContact', []));
        $contacts = [new EventContact()];

        for($i = 1; $i < $count; $i++) {
            $contacts[] = new EventContact();
        }

        $post = Yii::$app->request->post('EventContact');
        if (Model::loadMultiple($contacts, Yii::$app->request->post())) {
            $j = 0;
            foreach ($contacts as $contact) {
                $contact->event_id = $event_id;
                $contact->type = $post[$j]['type'];
                $contact->name = $post[$j]['name'];
                $contact->save();
                $j++;
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Contacts successfully added.'));
            return $this->redirect(['update', 'id' => $event_id]);

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Contacts are not added.'));
            return $this->redirect(['update', 'id' => $event_id]);
        }
    }

    public function actionAddSocials()
    {
        $event_id = Yii::$app->request->get('event_id');

        $count = count(Yii::$app->request->post('EventSocialMedia', []));
        $socials = [new EventSocialMedia()];
        for($i = 1; $i < $count; $i++) {
            $socials[] = new EventSocialMedia();
        }

        $post = Yii::$app->request->post('EventSocialMedia');
        if (Model::loadMultiple($socials, Yii::$app->request->post())) {
            $j = 0;
            foreach ($socials as $social) {
                $social->event_id = $event_id;
                $social->type = $post[$j]['type'];
                $social->name = $post[$j]['name'];
                $social->save();
                $j++;
            }
            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Social media is set successfully!'));
            return $this->redirect(['update', 'id' => $event_id]);

        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Social media did not set! Try again'));
            return $this->redirect(['update', 'id' => $event_id]);
        }
    }

    public function actionAddTags()
    {
        $event_id = Yii::$app->request->get('event_id');
        $POST_VARIABLE = Yii::$app->request->post('EventHasTags');

        if (Yii::$app->request->isPost) {
            foreach ($POST_VARIABLE['event_tag_id'] as $key => $event_tag_id) {
                $model = new EventHasTags();
                RecordHelpers::saveModelHasData($model, 'event_id', 'event_tag_id', $event_id, $event_tag_id);
            }

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Tags successfully added.'));
            return $this->redirect(['update', 'id' => $event_id]);
        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Tags are not added.'));
            return $this->redirect(['update', 'id' => $event_id]);
        }
    }

    public function actionAddUsers()
    {
        $event_id = Yii::$app->request->get('event_id');
        $POST_VARIABLE = Yii::$app->request->post('UserEvent');

        if (Yii::$app->request->isPost) {
            foreach ($POST_VARIABLE['user_id'] as $key => $user_id) {
                $model = new UserEvent();
                RecordHelpers::saveModelHasData($model, 'event_id', 'user_id', $event_id, $user_id);
            }

            Yii::$app->getSession()->setFlash("success", Yii::t('app', 'Users successfully added.'));
            return $this->redirect(['update', 'id' => $event_id]);
        } else {
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'Users are not added!'));
            return $this->redirect(['update', 'id' => $event_id]);
        }
    }

    public function actionDeleteItem()
    {
        $event_id = Yii::$app->request->get('event_id');
        $event_tag_id = Yii::$app->request->get('event_tag_id');
        $contact_id = Yii::$app->request->get('contact_id');
        $social_id = Yii::$app->request->get('social_id');
        $user_id = Yii::$app->request->get('user_id');

        $model = null;

        if ($event_tag_id) :
            $model = EventHasTags::findOne(['event_id' => $event_id, 'event_tag_id' => $event_tag_id]);
        endif;

        if ($contact_id) :
            $model = EventContact::findOne(['event_id' => $event_id, 'id' => $contact_id]);
        endif;

        if ($social_id) :
            $model = EventSocialMedia::findOne(['event_id' => $event_id, 'id' => $social_id]);
        endif;

        if ($user_id) :
            $model = UserEvent::findOne(['event_id' => $event_id, 'user_id' => $user_id]);
        endif;

        if (!is_null ($model)) :
            RecordHelpers::deleteOneRecord($model);
            return $this->redirect(['update', 'id' => $event_id]);
        else:
            Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'There is an error! Please try again'));
            return $this->redirect(['update', 'id' => $event_id]);
        endif;
    }

    public function actionBanner()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->image_file = UploadedFile::getInstance($model, 'image_file')) {
                $file_name = $model->id . '_' . rand() . rand() . date("Ymdhis") . '.' . $model->image_file->extension;

                $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['event'] . $file_name;

                GalleryHelper::uploadEvents($model->image_file->tempName, $path);

                $file_name = preg_replace('/\s+/', '', $file_name);
                $model->banner = $file_name;
                $model->save(0);

//                $thumbnail_file_name = 'tn_' . $file_name;
//                $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['thumbnails'] . $thumbnail_file_name;
//
//                $max_width_768 = 768;
//                $max_width_180 = 180;
//
//                $min_width_512 = 512;
//                $min_width_150 = 150;
//
//                $min_heigth_384 = 384;
//                $min_heigth_120 = 120;
//
//
//                if (Gallery::resizeBeforeUpload($model->image_file->tempName, $path, $max_width_768, $min_width_512, $min_heigth_384)) {
//
//                    //Save thumbnails
//                    Gallery::resizeBeforeUpload($model->image_file->tempName, $thumbnail_path, $max_width_180, $min_width_150, $min_heigth_120);
////                    echo $model->image;
//
//                }
            }
            return $this->redirect(Yii::$app->request->baseUrl . '/event/' . $id);
        }
    }
}