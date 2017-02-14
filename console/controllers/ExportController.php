<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 26/06/2016
 * Time: 11:07
 */

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Export;
use backend\models\Place;

class ExportController extends Controller
{
    public function actionIndex(){

//        $places = Place::findAll(['status' => 1]);
//
//        $model = new Export();
//        $model->deleteAll([]);
//
//        foreach ($places as $place) {
//            $rows = array();
//            $rows[] = [
//                'name' => $place->name,
//                'po_box' => $place->getContactNames(Yii::$app->params['PO_BOX']),
//                'emails' => $place->getContactNames(Yii::$app->params['EMAIL']),
//                'mobile_phones' => $place->getContactNames(Yii::$app->params['MOB_PHONE']),
//                'land_line' => $place->getContactNames(Yii::$app->params['LAND_LINE']),
//                'fax' => $place->getContactNames(Yii::$app->params['FAX']),
//                'webstes' => $place->getContactNames(Yii::$app->params['WEBSITE']),
//                'province' => $place->getProvinceName(),
//                'district' => $place->getDistrictName(),
//                'sector' => $place->getSectorName(),
//                'cell' => $place->getCellName(),
//                'village' => $place->village_id,
//                'neighborhood' => $place->neighborhood,
//                'street' => $place->street,
//
//            ];
//
//
//            Yii::$app->db->createCommand()->batchInsert(
//                Export::tableName(),
//                ['name', 'po_box', 'emails', 'mobile_phones', 'land_line', 'fax', 'webstes', 'province', 'district', 'sector', 'cell', 'village', 'neighborhood', 'street'],
//                $rows)->execute();
//        }
    }
}