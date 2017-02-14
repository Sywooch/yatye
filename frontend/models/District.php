<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 23/07/2016
 * Time: 21:39
 */

namespace frontend\models;

use Yii;
use common\models\District as BaseDistrict;
use yii\db\Query;

class District extends BaseDistrict
{

    public static function getActiveDistricts()
    {
        return (new Query())
            ->select('`district`.`id`')
            ->distinct()
            ->addSelect('`district`.`name`')
            ->addSelect('`province`.`name` as province_name ')
            ->from('`district`, `place`,`province` ')
            ->where('`district`.`id` = `place`.`district_id`')
            ->andWhere('`province`.`id` = `district`.`province_id`')
            ->andWhere('`province`.`id` = `place`.`province_id`')
            ->andWhere('`place`.`status` =' . Yii::$app->params['active'])
            ->orderBy('name')
            ->all();
    }

    public function getPlacesFromDistricts($category_id)
    {
        $query = new Query();

        $select = $query
            ->select('DISTINCT `place`.`id` as place_id')
            ->addSelect('`place`.`name` as place_name')
            ->addSelect('`place`.`description`')
            ->addSelect('`place`.`slug` as place_slug')
            ->addSelect('`place`.`province_id`')
            ->addSelect('`place`.`district_id`')
            ->addSelect('`place`.`neighborhood`')
            ->addSelect('`place`.`street`')
            ->addSelect('`place`.`profile_type`')
            ->addSelect('`place`.`logo`')
            ->addSelect('`service`.`id` as service_id')
            ->addSelect('`service`.`name` as service_name')
            ->addSelect('`service`.`category_id`')
            ->addSelect('`service`.`slug` as service_slug')
            ->addSelect('`category`.`slug` as `category_slug`')
            ->addSelect('`category`.`type` as `category_type`')
            ->addSelect('`category`.`name` as `category_name`')
            ->from('`service`, `place`, `place_service`, `category`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`category_id` = `category`.`id`')
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`district_id` = " . $this->id)
            ->andWhere('`service`.`category_id` = ' . $category_id)
            ->orderBy('place_id');
        return $select->all();
    }
}