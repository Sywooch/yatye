<?php

namespace backend\controllers;



use Yii;
use backend\models\Event;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use backend\models\EventContact;
use backend\models\EventHasTags;
use backend\models\EventSocialMedia;
use backend\models\Gallery;
use backend\models\UserEvent;
use common\helpers\Helpers;
use common\helpers\RecordHelpers;
use yii\web\UploadedFile;
use backend\components\BaseEventController;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends BaseEventController
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
}
