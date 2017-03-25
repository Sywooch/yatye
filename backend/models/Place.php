<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/01/2016
 * Time: 21:21
 */

namespace backend\models;

use common\helpers\RecordHelpers;
use common\helpers\ValueHelpers;
use common\models\Cell;
use common\models\District;
use common\models\Place as BasePlace;
use common\models\Province;
use common\models\Sector;
use frontend\models\Ratings;
use frontend\models\UserProfile;
use frontend\models\Views;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use Yii;
use yii\helpers\ArrayHelper;

class Place extends BasePlace
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
            [['name', 'slug', 'created_at'], 'required'],
            [['description'], 'string'],
            [['province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'profile_type', 'views', 'status', 'created_by', 'category', 'main'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'expire_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'logo', 'neighborhood', 'street'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    public function getLogo()
    {
        return Yii::$app->params['galleries'] . $this->logo;
    }

    public function getThumbnailLogo()
    {
        return ($this->logo != null) ? Yii::$app->params['thumbnails'] . $this->logo : Yii::$app->params['pragmaticmates-logo-jpg'];
    }

    public function getCurrentCategory($category_id)
    {
        return Category::findOne($category_id);
    }

    public function getServiceIds($category_id)
    {
        $category = $this->getCurrentCategory($category_id);
        return $category->getServiceIds();
    }

    public function getThisPlaceService($category_id)
    {
        $service_ids = $this->getServiceIds($category_id);
        return PlaceService::find()
            ->where(['in', 'service_id', $service_ids])
            ->andWhere(['place_id' => $this->id])
            ->one();
    }

    public function getServiceId($category_id)
    {
        $place_service = $this->getThisPlaceService($category_id);
        return $place_service->service_id;
    }

    public function getThisPlaceServiceName($category_id)
    {
        return Service::findOne($this->getServiceId($category_id))->name;
    }

    public function getViews()
    {
        return Views::findOne(['place_id' => $this->id, 'status' => Yii::$app->params['active']])->views;
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }

    public function getRatings()
    {
        $ratings = Ratings::findOne(['place_id' => $this->id]);

        return (!empty($ratings)) ? $ratings->average : 0;
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

    public function getProvinceName()
    {
        $province_name = NULL;
        if ($this->province_id) {
            $obj = Province::findOne($this->province_id);
            if ($obj) {
                $province_name = $obj->name;
            }
        }

        return $province_name;
    }

    public function getDistrictName()
    {
        $district_name = NULL;
        if ($this->district_id) {
            $obj = District::findOne($this->district_id);
            if ($obj) {
                $district_name = $obj->name;
            }
        }

        return $district_name;
    }

    public function getSectorName()
    {
        $sector_name = NULL;
        if ($this->sector_id) {
            $obj = Sector::findOne($this->sector_id);
            if ($obj) {
                $sector_name = $obj->name;
            }
        }

        return $sector_name;
    }

    public function getCellName()
    {
        $cell_name = NULL;
        if ($this->cell_id) {
            $obj = Cell::findOne($this->cell_id);
            if ($obj) {
                $cell_name = $obj->name;
            }
        }

        return $cell_name;
    }

    public function getContactNames($type)
    {
        $contacts = Contact::findAll(['place_id' => $this->id, 'type' => $type, 'status' => Yii::$app->params['active']]);

        $contact_name = array();
        foreach ($contacts as $contact) :

            $contact_name[] = $contact->name;

        endforeach;

        return implode('; ', $contact_name);
    }

    public function getProfileTypeName()
    {
        if ($this->profile_type == Yii::$app->params['PREMIUM']):
            $profile_type = Yii::t('app', 'Premium');
        elseif ($this->profile_type == Yii::$app->params['BASIC']):
            $profile_type = Yii::t('app', 'Basic');
        elseif ($this->profile_type == Yii::$app->params['FREE']):
            $profile_type = Yii::t('app', 'Free');
        else:
            $profile_type = Yii::t('app', 'Not Set');
        endif;

        return $profile_type;
    }

    public static function searchPlaces($post)
    {
        return Place::find()->filterWhere(['like', 'name', $post['name']]);;
    }

    public function getGalleries()
    {
        return Gallery::find()
            ->where(['place_id' => $this->id])
            ->orderBy(new Expression('RAND()'))
            ->limit(1)
            ->all();
    }

    public function getPhoto()
    {
        $photo = array();
        $galleries = $this->getGalleries();
        foreach ($galleries as $gallery) {
            $photo[] = $gallery->name;
        }

        Yii::warning('galleries : ' . $photo[0]);
        return Yii::$app->params['galleries'] . $photo[0];
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
            ->addSelect('`place_service`.`place_id`')
            ->from('`service`, `place`, `place_service`, `category`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
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