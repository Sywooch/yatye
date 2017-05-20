<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/02/2016
 * Time: 19:52
 */

namespace frontend\controllers\user;

use Yii;
use common\helpers\DataHelpers;
use dektrium\user\controllers\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController
{

    public function accessData()
    {
        return [
            'get_keywords' => DataHelpers::getKeywords(),
            'all_categories' => DataHelpers::getAllCategories(),
        ];
    }

    public static function getAds()
    {
        return DataHelpers::getAds();
    }

    public static function getKeywords()
    {
        return DataHelpers::getKeywords();
    }

    public static function getAllCategories()
    {
        return DataHelpers::getAllCategories();
    }

    public static function getUpcomingEvents()
    {
        return DataHelpers::getUpcomingEvents();
    }

    public static function getPostArchives()
    {
        return DataHelpers::getPostArchives();
    }

    public static function getPlaceContacts($place_id)
    {
        return DataHelpers::getPlaceContacts($place_id);
    }


//    /**
//     * Logs in a user.
//     *
//     * @return mixed
//     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            $this->goBack();
//        }
//
//        /** @var LoginForm $model */
//        $model = Yii::createObject(LoginForm::className());
//
//        $this->performAjaxValidation($model);
//
//        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
//            return $this->redirect(Yii::$app->request->baseUrl . '/dashboard');
//        } else {
//            return $this->render('login', [
//                'model' => $model,
//                'module' => $this->module,
//            ]);
//        }
//
//
//    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout();

        return $this->redirect(Yii::$app->request->referrer);
    }
}