<?php

namespace backend\controllers;

use backend\models\EventContact;
use backend\models\EventHasTags;
use backend\models\EventSocialMedia;
use backend\models\Gallery;
use backend\models\User;
use backend\models\UserEvent;
use common\helpers\Helpers;
use common\helpers\RecordHelpers;
use Yii;
use backend\models\Event;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use backend\components\AdminController as BackendAdminController;
use yii\web\UploadedFile;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends BackendAdminController
{

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
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
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = Helpers::getStatus();
        $profile_types = Helpers::getProfileType();


        $contact_types = Helpers::getContactTypes();
        $contacts = [new EventContact()];
        $contactDataProvider = new ActiveDataProvider([
            'query' => EventContact::find()->where(['event_id' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Socials*/
        $social_types = Helpers::getSocialTypes();
        $socials = [new EventSocialMedia()];
        $socialDataProvider = new ActiveDataProvider([
            'query' => EventSocialMedia::find()->where(['event_id' => $id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*Tags*/
        $event_has_tags = new EventHasTags();
        $tags = EventHasTags::getNotTags($id);
        $tagDataProvider = new ArrayDataProvider([
            'allModels' => $model->getTags(),
            'sort' => [
                'attributes' => ['name'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        /*User*/
        $user_event = new UserEvent();
        $users = UserEvent::getUsers($id);
        $userDataProvider = new ArrayDataProvider([
            'allModels' => $model->getEventUsers(),
            'sort' => [
                'attributes' => ['email'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'status' => $status,
                'profile_types' => $profile_types,

                /*Contacts*/
                'contactDataProvider' => $contactDataProvider,
                'contact_types' => $contact_types,
                'contacts' => $contacts,

                /*Socials*/
                'socialDataProvider' => $socialDataProvider,
                'social_types' => $social_types,
                'socials' => $socials,

                /*Tags*/
                'tagDataProvider' => $tagDataProvider,
                'event_has_tags' => $event_has_tags,
                'tags' => $tags,

                /*User*/
                'userDataProvider' => $userDataProvider,
                'user_event' => $user_event,
                'users' => $users,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
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
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

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

                $thumbnail_file_name = 'tn_' . $file_name;
                $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['event_thumbnail'] . $thumbnail_file_name;

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
                    $model->banner = $file_name;
                    $model->save(0);
                }
            }
            return $this->redirect(Yii::$app->request->baseUrl . '/event/' . $id);
        }
    }
}
