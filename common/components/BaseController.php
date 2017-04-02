<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 10/02/2016
 * Time: 23:56
 */

namespace common\components;

use Yii;
use yii\helpers\Json;
use common\helpers\DataHelpers;
use backend\models\place\Place;


class BaseController extends SuperController
{

    public function getUrl($place_id)
    {
        $place = Place::findOne($place_id);
        $url = 'http://';
        if (Yii::$app->controller->id == 'place') :
            $url = Yii::$app->request->baseUrl . '/place/' . $place_id . '/' . $place->slug;
        endif;

        if (Yii::$app->controller->id == 'settings') :
            $url = Yii::$app->request->baseUrl . '/settings/?id=' . $place_id;
        endif;

        return $url;
    }

    public function actionServices()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $cat_id = $parents[0];

                $out = DataHelpers::getServices($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionDistricts()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $cat_id = $parents[0];

                $out = DataHelpers::getDistricts($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionSectors()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $cat_id = $parents[0];

                $out = DataHelpers::getSectors($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionCells()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $cat_id = $parents[0];

                $out = DataHelpers::getCells($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionPostCategories()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];

            if ($parents != null) {
                $cat_id = $parents[0];

                $out = DataHelpers::getPostCategories($cat_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}