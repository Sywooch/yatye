<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/22/17
 * Time: 10:09 PM
 */

namespace backend\models\place;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use frontend\models\Views;
use common\helpers\ValueHelpers;
use common\models\Category as BaseCategory;

class CategoryData extends BaseCategory
{
    public function getServices()
    {
        return Service::findAll(['category_id' => $this->id, 'status' => Yii::$app->params['active']]);
    }
    public function getPlaceServices()
    {
        return (new Query())
            ->select('DISTINCT `place_service`.`place_id`')
            ->from('`service`, `place_service`')
            ->where('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`category_id` = ' . $this->id)
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->all();
    }

    public static function getAllCategories()
    {
        return self::find()->orderBy('name')->all();
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }

    public function getViews()
    {
        return Views::find()
//            ->where(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('views DESC'))
            ->all();
    }

}