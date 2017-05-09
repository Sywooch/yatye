<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/09/2016
 * Time: 12:50
 */

namespace api\modules\v1\actions\user;

use api\modules\v1\models\User;
use Yii;
use yii\rest\Action;
use yii\web\Response;

class LoginAction extends Action
{
    public function run()
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $email = $request->getBodyParam('email');
        $password = $request->getBodyParam('password');


        if (!$email && !$password) {
            $response->statusCode = 422;
            $response->data = [
                'success' => $response->isSuccessful,
                'message' => Yii::t('app', 'Required values were not supplied!'),
                'status' => $response->statusCode
            ];
            return $response;
        }

        $model = User::findOne(["email" => $email]);

        if (empty($model)) {
            $response->statusCode = 404;
            $response->data = [
                'success' => $response->isSuccessful,
                'message' => Yii::t('app', 'User not found!'),
                'status' => $response->statusCode
            ];
            return $response;
        } elseif ($model->blocked_at != null) {
            $response->statusCode = 403;
            $response->data = [
                'success' => $response->isSuccessful,
                'message' => Yii::t('app', 'Your account has been blocked!'),
                'status' => $response->statusCode
            ];
            return $response;
        } elseif (!$model->validatePassword($password)) {
            $response->statusCode = 401;
            $response->data = [
                'success' => $response->isSuccessful,
                'message' => 'Wrong username or password!',
                'status' => $response->statusCode
            ];
            return $response;
        } elseif ($model->validatePassword($password)) {
            $response->statusCode = 201;
            $response->data = [
                'success' => $response->isSuccessful,
                'message' => Yii::t('app', 'Successfully authenticated!'),
                'status' => $response->statusCode,
                'data' => $model,
            ];
            return $response;
        } else {
            $response->statusCode = 500;
            $response->data = [
                'message' => Yii::t('app', 'Internal server error.'),
                'status' => $response->statusCode
            ];
            return $response;
        }
    }
}