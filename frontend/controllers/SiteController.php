<?php
namespace frontend\controllers;


use backend\models\Event;
use backend\models\Subscription;
use frontend\models\Enquiry;
use Yii;
use frontend\models\ContactForm;
use backend\models\Category;
use common\components\BaseController;
use common\models\Place;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'home';
        $service_categories = Category::find()
            ->where(['status' => Yii::$app->params['active']])
            ->andWhere(['!=', 'id', 5])
            ->orderBy('RAND()')
            ->all();

        $up_coming_events = Event::find()
            ->where(new Expression('`start_date` >= CURRENT_DATE'))
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('`start_date` ASC LIMIT 6'))
            ->all();

        return $this->render('index', [
            'service_categories' => $service_categories,
            'up_coming_events' => $up_coming_events,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $place = Place::findOne(['id' => 30, 'code' => 'GUIDE00030']);
        $ip_address = Yii::$app->request->getUserIP();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Enquiry::saveEnquiry($place->id, $model);
                Subscription::saveUserToSubscription($model->email);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('fail', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'description' => $place->description,
                'ip_address' => $ip_address,

            ]);
        }
    }


    public function actionTermsConditions()
    {
        return $this->render('terms-conditions');
    }

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy-policy');
    }

    public function actionRobots()
    {

        header('Content-Type: text/plain');
        return $this->renderPartial('/site/robots');
    }

    public function actionSitemap()
    {
        header('Content-Type: text/xml');
        return $this->renderPartial('/site/sitemap');
    }

}
