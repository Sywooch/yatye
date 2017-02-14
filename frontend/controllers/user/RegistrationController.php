<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/03/2016
 * Time: 00:17
 */

namespace frontend\controllers\user;

use common\components\BaseController;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;

class RegistrationController extends BaseRegistrationController
{
    public function accessData()
    {
        return BaseController::accessData();
    }

    public function accessDataByIds($id)
    {
        return BaseController::accessDataByIds($id);
    }
}