<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/03/2016
 * Time: 00:17
 */

namespace frontend\controllers\user;

use common\components\BaseController;
use common\helpers\DataHelpers;
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

    public static function getAds()
    {
        return DataHelpers::getAds();
    }

    public static function getKeywords()
    {
        return DataHelpers::getKeywords();
    }

    public static function getAllCategories()
    {
        return DataHelpers::getAllCategories();
    }

    public static function getUpcomingEvents()
    {
        return DataHelpers::getUpcomingEvents();
    }

    public static function getPostArchives()
    {
        return DataHelpers::getPostArchives();
    }

    public static function getPlaceContacts($place_id)
    {
        return DataHelpers::getPlaceContacts($place_id);
    }
}