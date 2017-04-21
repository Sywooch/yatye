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

        $post = Yii::$app->request->bodyParams;
        $email = $post['email'];
        $password = $post['password'];

        $model = User::findOne(["email" => $email]);

        if (empty($model)) {
            $response->statusCode = 404;
            $response->data = ['message' => 'User not found!', 'code' => $response->statusCode];
            return $response;
        }

        if (!empty($model) && $model->validatePassword($password)) {
            $model->save(false);
            $response->statusCode = 201;
            $response->data = ['message' => 'Successfully authenticated!', 'data' => $model, 'code' => $response->statusCode];
            return $response;
        } else {
            $response->statusCode = 401;
            $response->data = ['message' => 'Authentication failed!', 'code' => $response->statusCode];
            return $response;
        }
    }
}