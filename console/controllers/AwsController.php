<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/25/17
 * Time: 2:51 PM
 */

namespace console\controllers;

use common\helpers\S3Helpers;
use Yii;
use backend\models\place\Place;
use common\helpers\GalleryHelper;
use yii\console\Controller;

class AwsController extends Controller
{

    // ./yii aws/upload
    public function actionUpload()
    {
        $places = Place::find()->all();
        if (!empty($places)) {
            foreach ($places as $place) {
                GalleryHelper::getPhotos($place);
            }
        }
    }
}