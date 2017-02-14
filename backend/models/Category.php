<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/02/2016
 * Time: 20:06
 */

namespace backend\models;

use backend\models\Service;
use Yii;
use common\models\Category as BaseCategory;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

class Category extends BaseCategory
{

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'type'], 'integer'],
            [['name', 'slug', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['type'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'status' => 'Status',
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
                'updatedByAttribute' => false,
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],
//            'bedezign\yii2\audit\AuditTrailBehavior',

        ];
    }

    public function selectPlacesFromCategories()
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
            ->andWhere('`service`.`category_id` = ' . $this->id)
//            ->orderBy('place_id');
            ->orderBy(new Expression('RAND()'));
        return $select;
    }

    public function getCategoryList()
    {
        $select = $this->selectPlacesFromCategories()
            ->andWhere('`category`.`type` = ' . Yii::$app->params['C_TYPE']);

        return $select->groupBy('`place_service`.`place_id`')->all();
    }

    public function getRandomPictures($category_id, $district_id = null)
    {

        $query = new Query();

        $select = $query
            ->select('`place`.`logo`')
            ->from('`service`, `place`, `place_service`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
//            ->andWhere('`place`.`id` = `gallery`.`place_id`')
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`status` = " . Yii::$app->params['active'])
            ->andWhere('`service`.`type` != ' . Yii::$app->params['E_TYPE'])
            ->andWhere('`service`.`category_id` = ' . $category_id);

        if ($district_id) :
            $select = $select->andWhere('`place`.`district_id` = ' . $district_id);
        endif;

        $select = $select->orderBy('RAND() LIMIT 1');
        return $select->one();

    }

    public function getPlacesFromCategories($profile_type)
    {

        $select = $this->selectPlacesFromCategories()
            ->andWhere('`place`.`profile_type` = "' . $profile_type . '"');

        return $select->groupBy('`place_service`.`place_id`')->all();

    }

    public function getMostViewed()
    {

        $query = new Query();

        $select = $query
            ->select('DISTINCT `place`.`name`')
            ->addSelect('`place`.`slug`')
            ->addSelect('`views`.`views`')
            ->from('`service`, `place`, `place_service`, `views`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`place`.`id` = `views`.`place_id`')
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`views`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`views`.`views` >= 10 ")
            ->andWhere('`service`.`category_id` = ' . $this->id)
            ->orderBy('`views`.`views` DESC')
            ->limit(5);
        return $select->all();
    }

    public function getPlaces($category)
    {
        return $this->selectPlacesFromCategories()
            ->andWhere('`place`.`category` = "' . $category . '"')
            ->groupBy('`place_service`.`place_id`')
            ->all();
    }

    public function getAPlaces()
    {
        return $this->getPlaces(Yii::$app->params['A_CATEGORY']);
    }

    public function getBPlaces()
    {
        return $this->getPlaces(Yii::$app->params['B_CATEGORY']);
    }

    public function getPremiumPlaces()
    {
        return $this->getPlacesFromCategories(Yii::$app->params['PREMIUM']);
    }

    public function getBasicPlaces()
    {
        return $this->getPlacesFromCategories(Yii::$app->params['BASIC']);
    }

    public function getFreePlaces()
    {
        return $this->getPlacesFromCategories(Yii::$app->params['FREE']);
    }

    public function getPremiumAndBasicPlaces()
    {
        $select = $this->selectPlacesFromCategories()
            ->andWhere(new Expression('`place`.`profile_type` = "' . Yii::$app->params['PREMIUM'] . '" OR `place`.`profile_type` = "' . Yii::$app->params['BASIC'] . '"'));
        return $select->groupBy('`place_service`.`place_id`')->all();
    }

    public function getService()
    {
        return Service::findAll(['category_id' => $this->id, 'status' => Yii::$app->params['active']]);
    }

    public static function getAllCategories()
    {
        return self::find()->orderBy('name')->all();
    }

    public function getNearbyPlaces($distance)
    {
        $query = new Query();

        try {
//            $url = 'http://freegeoip.net/json/github.com';
            $url = 'http://freegeoip.net/json/' . Yii::$app->request->getUserIP();
            $get_ip_info = json_decode(file_get_contents($url), true);
        } catch (\Exception $e) {
            //error
        }
        $select = $query
            ->select('DISTINCT `place`.`id` as place_id')
            ->addSelect('`place`.`name` as place_name')
            ->addSelect('`place`.`description`')
            ->addSelect('`place`.`slug` as place_slug')
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
            ->addSelect('( 6371 * acos( cos( radians(' . $get_ip_info['latitude'] . ') ) * cos( radians( `place`.`latitude` ) ) * cos( radians( `place`.`longitude` ) - radians(' . $get_ip_info['longitude'] . ') ) + sin( radians(' . $get_ip_info['latitude'] . ') ) * sin( radians( `place`.`latitude` ) ) ) ) AS distance')
            ->from('`service`, `place`, `place_service`, `category`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`category_id` = `category`.`id`')
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`status` = " . Yii::$app->params['active'])
            ->andWhere('`service`.`category_id` = ' . $this->id)
            ->having('distance < ' . $distance);


        echo $get_ip_info['ip'];
        return $select->groupBy('`place_service`.`place_id`')->all();

    }

    public function searchPlaces($POST_VARIABLE)
    {

        $conditions = array();

        $place_name = $POST_VARIABLE['name'];
        $category_id = $POST_VARIABLE['category_id'];
//        $service_id = $POST_VARIABLE['service_id'];
        $province_id = $POST_VARIABLE['province_id'];
//        $district_id = $POST_VARIABLE['district_id'];

        if (isset($place_name) && !empty($place_name)) {

            $conditions[] = " place_name LIKE '%" . $place_name . "%'";
        }

        if (isset($category_id) && !empty($category_id)) {

            $conditions[] = " service . category_id" . " = " . $category_id;
        }

//        if (isset($service_id) && !empty($service_id)) {
//
//            $conditions[] = " service ." . $service_id . " = " . $service_id;
//        }

        if (isset($province_id) && !empty($province_id)) {

            $conditions[] = " place . province_id" . " = " . $province_id;
        }

//        if (isset($district_id) && !empty($district_id)) {
//
//            $conditions[] = " place . district_id " . " = " . $district_id;
//        }

        // builds the query
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
            ->andWhere('`service`.`category_id` = ' . $category_id);

        if (count($conditions) > 0) {
            // append the conditions
            $select = $select->where(implode(' AND ', $conditions));
        }

        return $select->orderBy(new Expression('RAND()'))->all();
    }
}