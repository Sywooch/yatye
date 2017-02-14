<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/02/2016
 * Time: 19:52
 */

namespace backend\controllers\user;

use backend\models\User;
use common\models\LoginForm;
use Yii;
use dektrium\user\controllers\SecurityController as BaseSecurityController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;


class SecurityController extends BaseSecurityController
{

    /**
     * Displays the login page.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {

            $user = User::findIdentity(Yii::$app->user->id);

            if(!$user->isSuperAdmin()){

                Yii::$app->user->logout();
                Yii::$app->session->setFlash('warning', Yii::t('user', 'You do not have access to Admin Site.'));
                return $this->goHome();
            }
            return $this->goBack();
        }

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
}