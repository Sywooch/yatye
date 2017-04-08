<?php

namespace frontend\controllers;

use Yii;
use backend\models\AboutUs;
use yii\data\ActiveDataProvider;
use common\helpers\MetaTagHelpers;
use common\components\BaseController;

class AboutUsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
