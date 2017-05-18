<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/01/2016
 * Time: 21:21
 */

namespace backend\models\place;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

class Place extends PlaceData
{

    public $distance;
    public $category_id;
    public $service_id;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
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
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'on' => ['create', 'update']],
            [['slug'], 'required'],
            [['description'], 'string'],
            [['province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'profile_type', 'views', 'status', 'created_by', 'category', 'main'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'expire_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'logo', 'neighborhood', 'street'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    public function getThisPlaceHasService($category_id)
    {
        $sql = "SELECT `service`.* 
                FROM `place_has_service`, `service` 
                WHERE `place_has_service`.`service_id` = `service`.`id` 
                AND `service`.`category_id` = " . $category_id ." 
                AND `place_has_service`.`place_id` = " . $this->id . " 
                AND `service`.`status` = " . Yii::$app->params['active'] . " 
                ORDER BY RAND() LIMIT 1";
        return Service::findBySql($sql)->one();
    }

    public function getRatingStars()
    {
        $stars = '';
        $ratings = $this->getRatings();
        for ($i = 1; $i <= 5; $i++) {
            if ($ratings < $i) {
                $stars .= '<i class="fa fa fa-star-o ratings"></i>';
            } else {
                $stars .= '<i class="fa fa fa-star ratings"></i>';
            }
        }
        return $stars;
    }

    public function getPhoto()
    {
        $photo = array();
        $galleries = $this->getGalleries();
        foreach ($galleries as $gallery) {
            $photo[] = $gallery->name;
        }

        return (!empty($photo)) ? Yii::$app->params['galleries'] . $photo[0] : Yii::$app->params['pragmaticmates-logo-jpg'];
    }

    public static function getPlacesWithEmptyFields()
    {
        $condition = ['status' => Yii::$app->params['active']];

        $descriptions = Place::find()->where($condition)->andWhere(new Expression('`description` IS NULL OR `description` =""'));
        $slugs = Place::find()->where($condition)->andWhere(new Expression('`slug` IS NULL OR `slug` =""'));
        $logos = Place::find()->where($condition)->andWhere(new Expression('`logo` IS NULL OR `logo` =""'));
        $provinces = Place::find()->where($condition)->andWhere(new Expression('`province_id` IS NULL OR `province_id` = 0'));
        $districts = Place::find()->where($condition)->andWhere(new Expression('`district_id` IS NULL OR `district_id` = 0'));
        $sectors = Place::find()->where($condition)->andWhere(new Expression('`sector_id` IS NULL OR `sector_id` = 0'));
        $cells = Place::find()->where($condition)->andWhere(new Expression('`cell_id` IS NULL OR `cell_id` = 0'));
        $neighborhoods = Place::find()->where($condition)->andWhere(new Expression('`neighborhood` IS NULL OR `neighborhood` =""'));
        $streets = Place::find()->where($condition)->andWhere(new Expression('`street` IS NULL OR `street` =""'));
        $latitudes = Place::find()->where($condition)->andWhere(new Expression('`latitude` IS NULL'));
        $longitudes = Place::find()->where($condition)->andWhere(new Expression('`longitude` IS NULL'));
        $profile_types = Place::find()->where($condition)->andWhere(new Expression('`profile_type` IS NULL'));

        return [
            'descriptions' => $descriptions,
            'slugs' => $slugs,
            'logos' => $logos,
            'provinces' => $provinces,
            'districts' => $districts,
            'sectors' => $sectors,
            'cells' => $cells,
            'neighborhoods' => $neighborhoods,
            'streets' => $streets,
            'latitudes' => $latitudes,
            'longitudes' => $longitudes,
            'profile_types' => $profile_types,
        ];
    }

    public static function getPlacesWithoutContacts()
    {
        return [
            'physical_addresses' => Contact::getPlaceFromContactType(Yii::$app->params['PHYSICAL_ADDRESS']),
            'po_boxes' => Contact::getPlaceFromContactType(Yii::$app->params['PO_BOX']),
            'mob_phones' => Contact::getPlaceFromContactType(Yii::$app->params['MOB_PHONE']),
            'land_lines' => Contact::getPlaceFromContactType(Yii::$app->params['LAND_LINE']),
            'faxes' => Contact::getPlaceFromContactType(Yii::$app->params['FAX']),
            'emails' => Contact::getPlaceFromContactType(Yii::$app->params['EMAIL']),
            'websites' => Contact::getPlaceFromContactType(Yii::$app->params['WEBSITE']),
            'skypes' => Contact::getPlaceFromContactType(Yii::$app->params['SKYPE']),
        ];
    }

    public static function getPlacesWithoutSocialMedia()
    {
        return [
            'facebook' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['FACEBOOK']),
            'twitter' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['TWITTER']),
            'instagram' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['INSTAGRAM']),
            'linkedin' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['LINKEDIN']),
            'pintrest' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['PINTREST']),
            'tumblr' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['TUMBLR']),
            'youtube' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['YOUTUBE']),
            'google_plus' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['GOOGLE_PLUS']),
            'flicklr' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['FLICKLR']),
            'trip_advisor' => SocialMedia::getPlaceFromSocialMediaType(Yii::$app->params['TRIPADVISOR']),
        ];
    }


    /*###################################################################################*/


    public function generateCodes($place)
    {
        $initial_code = 'GUIDE';
        $code = '';
        if ($place->id < 10) {
            $code = $initial_code . '0000' . $place->id;
        } elseif ($place->id < 100) {
            $code = $initial_code . '000' . $place->id;
        } elseif ($place->id < 1000) {
            $code = $initial_code . '00' . $place->id;
        } elseif ($place->id < 10000) {
            $code = $initial_code . '0' . $place->id;
        }
        $this->code = $code;
        $this->save(0);
    }

    public function getServices()
    {
        $query = new Query();

        $select = $query
            ->select('`service`.`id`')
            ->addSelect('`service`.`name`')
            ->addSelect('`service`.`category_id`')
            ->addSelect('`service`.`status`')
            ->addSelect('`category`.`name` as category_name')
            ->addSelect('`place_has_service`.`place_id`')
            ->from('`service`, `place`, `place_has_service`, `category`')
            ->where('`place`.`id` = `place_has_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_has_service`.`service_id`')
            ->andWhere('`service`.`category_id` = `category`.`id`')
            ->andWhere('`place`.`id` = ' . $this->id)
            ->orderBy('category_name')
            ->all();

        return $select;
    }

    public function getContacts()
    {
        return Contact::find()
            ->where(['place_id' => $this->id, 'status' => Yii::$app->params['active']])
            ->orderBy('type')->all();
    }

    public function getOtherPlaces()
    {
        $query = new Query();

        $select = $query
            ->select('`place`.`id`')
            ->addSelect('`place`.`name`')
            ->addSelect('`place`.`slug`')
            ->addSelect('`place`.`logo`')
            ->addSelect('`place`.`street`')
            ->addSelect('`place`.`neighborhood`')
            ->addSelect('`place`.`status`')
            ->addSelect('`place_has_another`.`place_id`')
            ->from('`place`, `place_has_another`')
            ->where('`place`.`id` = `place_has_another`.`other_place_id`')
            ->andWhere('`place_has_another`.`place_id` = ' . $this->id)
            ->orderBy('`place`.`name`')->all();

        return $select;
    }

    /** The Haversine formula is used generally for
     * computing great-circle distances between two pairs
     * of coordinates on a sphere
     * SELECT id, ( 3959 * acos( cos( radians(-1.95375538) ) * cos( radians( latitude ) ) * cos( radians( longitude )
     * - radians(30.06206512) ) + sin( radians(-1.95375538) ) * sin( radians( latitude ) ) ) ) AS distance
     * FROM place HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;
     */
    public function getHaversineFormula()
    {
        $formula = '( 6371 * acos( cos( radians(' . $this->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude )';
        $formula .= '- radians(' . $this->longitude . ') ) + sin( radians(' . $this->latitude . ') ) * sin( radians( latitude ) ) ) ) AS distance';
        return $formula;
    }

    public function getPlaceIdsFromTheGreatCircleDistances()
    {
        $query = new Query();

        $formula = $this->getHaversineFormula();
        $places = $query
            ->select('`id`')
            ->addSelect($formula)
            ->from('`place`')
            ->where(['status' => Yii::$app->params['active']])
            ->andWhere(['!=', 'id', $this->id])
            ->having('distance < 0.5')
            ->orderBy('RAND()')
            ->limit(6)
            ->all();

        $ids = array();

        foreach ($places as $place) {
            $ids[] = $place['id'];
        }
        return $ids;
    }

    public function getNearByPlaces()
    {
        $ids = $this->getPlaceIdsFromTheGreatCircleDistances();
        return Place::find()->where(['in', 'id', $ids]);
    }

    public static function getRecentAddedPlaces()
    {
        return Place::find()
            ->where(['status' => Yii::$app->params['active']])
            ->orderBy(['created_at' => SORT_DESC])->limit(5)
            ->all();
    }

    public function getContact($contact_type)
    {
        return Contact::findAll(['place_id' => $this->id, 'type' => $contact_type]);
    }

    public function getPlaceUsers()
    {
        $query = new Query();

        $select = $query
            ->select('`user`.`id`')
            ->addSelect('`user`.`email`')
            ->addSelect('`user_place`.`place_id`')
            ->from('`user`, `place`, `user_place`')
            ->where('`place`.`id` = `user_place`.`place_id`')
            ->andWhere('`user`.`id` = `user_place`.`user_id`')
            ->andWhere('`place`.`id` = ' . $this->id)
            ->orderBy('`user`.`email`')
            ->all();
        return $select;
    }

}