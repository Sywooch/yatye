<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/02/2016
 * Time: 19:52
 */

namespace frontend\controllers\user;

use common\models\LoginForm;
use Yii;
use common\components\BaseController;
use dektrium\user\controllers\SecurityController as BaseSecurityController;

class SecurityController extends BaseSecurityController
{

    public function accessData()
    {
        return BaseController::accessData();
    }

    public function accessDataByIds($id)
    {
        return BaseController::accessDataByIds($id);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
            return $this->redirect(Yii::$app->request->baseUrl . '/dashboard');
        } else {
            return $this->render('login', [
                'model' => $model,
                'module' => $this->module,
            ]);
        }


    }

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