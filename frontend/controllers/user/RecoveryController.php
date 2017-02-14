<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/03/2016
 * Time: 01:56
 */

namespace frontend\controllers\user;
use common\components\BaseController;
use dektrium\user\controllers\RecoveryController as BaseRecoveryController;

class RecoveryController extends BaseRecoveryController
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