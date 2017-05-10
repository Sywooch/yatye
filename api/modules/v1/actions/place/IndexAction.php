<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/09/2016
 * Time: 11:27
 */

namespace api\modules\v1\actions\place;

use Yii;
use yii\rest\Action;
use yii\web\Response;
use app\modules\v1\models\Place;

class IndexAction extends Action
{
    public function run()
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        $places = Place::findAll(['status' => Yii::$app->params['active']]);
        $user = Yii::$app->user->identity;

        if (empty($places)) {
            $response->statusCode = 404;
            $response->data = ['message' => 'Places not found.', 'code' => $response->statusCode];
            return $response;
        } elseif (!empty($places)) {
            $response->statusCode = 200;
            $response->data = ['data' => $places, 'code' => $response->statusCode];
            return $response;
        }
        else{
            $response->statusCode = 500;
            $response->data = ['message' => 'Internal server error.', 'code' => $response->statusCode];
            return $response;
        }
    }
}