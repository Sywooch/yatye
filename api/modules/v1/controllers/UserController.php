<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/09/2016
 * Time: 12:53
 */

namespace api\modules\v1\controllers;


use api\components\BaseController;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class UserController extends  BaseController
{
    public $modelClass = 'api\modules\v1\models\User';

    public function actions()
    {
        $actions = parent::actions();

        ArrayHelper::remove($actions, 'index');
        ArrayHelper::remove($actions, 'view');
        ArrayHelper::remove($actions, 'create');
        ArrayHelper::remove($actions, 'update');
        ArrayHelper::remove($actions, 'delete');
        ArrayHelper::remove($actions, 'options');

        return ArrayHelper::merge($actions, [
            'index' => [
                'class' => 'api\modules\v1\actions\user\IndexAction',
                'modelClass' => $this->modelClass,
            ],
            'login' => [
                'class' => 'api\modules\v1\actions\user\LoginAction',
                'modelClass' => $this->modelClass,
            ],
        ]);
    }
}