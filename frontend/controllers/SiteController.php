<?php
namespace frontend\controllers;

use Yii;
use common\models\Place;
use frontend\models\Enquiry;
use frontend\models\ContactForm;
use backend\models\place\Category;
use common\components\BaseController;
use backend\models\place\Subscription;


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
            ->andWhere(['!=', 'id', 7])
            ->andWhere(['!=', 'id', 8])
            ->orderBy('RAND()')
            ->all();
        return $this->render('index', [
            'service_categories' => $service_categories,
        ]);
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
