<?php

namespace frontend\controllers;

use common\components\BaseController;
class AboutUsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
