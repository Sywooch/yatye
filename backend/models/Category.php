<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/02/2016
 * Time: 20:06
 */

namespace backend\models;


use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use frontend\models\Views;
use common\helpers\ValueHelpers;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\models\Category as BaseCategory;
use yii\db\Query;

class Category extends BaseCategory
{
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by', 'type'], 'integer'],
            [['name', 'slug', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['type', 'status'], 'default', 'value' => 0],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],

            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],
        ];
    }

    public function getServices()
    {
        return Service::findAll(['category_id' => $this->id, 'status' => Yii::$app->params['active']]);
    }

    public function getServiceIds()
    {
        $services = $this->getServices();
        $service_ids = array();
        foreach ($services as $service) {
            $service_ids[] = $service->id;
        }
        return $service_ids;
    }

    public function getPlaceServices()
    {
        return (new Query())
            ->select('DISTINCT `place_service`.`place_id`')
            ->from('`service`, `place_service`')
            ->where('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`category_id` = ' . $this->id)
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere('`service`.`type` != ' . Yii::$app->params['E_TYPE'])
            ->all();
    }

    public function getPlaceIds()
    {

        $place_ids = array();
        $place_services = $this->getPlaceServices();

        foreach ($place_services as $place_service) {
            $place_ids[] = $place_service['place_id'];
        }
        return $place_ids;
    }

    public function getList()
    {
        $place_ids = $this->getPlaceIds();
        return Place::find()
            ->where(['in', 'id', $place_ids])
            ->andWhere(['status' => Yii::$app->params['active']]);
    }

    public function getOneRandomPlace()
    {
        $list = $this->getList();
        return $list->andWhere(['!=', 'logo', ''])
            ->orderBy(new Expression('RAND()'))
            ->limit(1)
            ->all();
    }

    public function getPictures()
    {
        $logos = array();
        $places = $this->getOneRandomPlace();
        foreach ($places as $place) {
            $logos[] = $place->logo;
        }
        return Yii::$app->params['thumbnails'] . $logos[0];
    }

    public function getPremiumList()
    {
        return $this->getList()
            ->andWhere(['profile_type' => Yii::$app->params['PREMIUM']])
            ->orderBy(new Expression('RAND()'))
            ->limit(6);
    }

    public function getBasicList()
    {
        return $this->getList()
            //->andWhere(['profile_type' => Yii::$app->params['BASIC']])
            ->orderBy(new Expression('`profile_type` <> ' . Yii::$app->params['PREMIUM'] . ', RAND()'))
            ->limit(6);
    }

    public function getFreeList()
    {
        return $this->getList()
            //->andWhere(['profile_type' => Yii::$app->params['FREE']])
            ->orderBy(new Expression('`profile_type` <> ' . Yii::$app->params['BASIC'] . ', RAND()'))
            ->limit(16);
    }

    public function getViews()
    {
        return Views::findAll(['status' => Yii::$app->params['active']]);
    }

    public function getMostViewed()
    {
        $views = $this->getViews();
        $place_ids = array();
        foreach ($views as $view) {
            $place_ids[] = $view->views;
        }
        return Place::find()
            ->where(['in', 'id', $place_ids])
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('views DESC'))
            ->limit(5)
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
}