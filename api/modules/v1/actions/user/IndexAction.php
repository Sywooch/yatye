<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/09/2016
 * Time: 12:52
 */

namespace api\modules\v1\actions\user;

use Yii;
use api\modules\v1\models\User;
use yii\rest\Action;
use yii\web\Response;

class IndexAction extends Action
{

    public function run()
    {
        $users = User::find()->all();

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        if (empty($users)) {
            $response->statusCode = 404;
            $response->data = ['message' => 'Users not found.', 'code' => $response->statusCode];
            return $response;
        } elseif (!empty($users)) {
            $response->statusCode = 200;
            $response->data = ['data' => $users, 'code' => $response->statusCode];
            return $response;
        } else {
            $response->statusCode = 500;
            $response->data = ['message' => 'Internal server error.', 'code' => $response->statusCode];
            return $response;
        }
    }
}