<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 07/02/2016
 * Time: 20:06
 */

namespace backend\models\place;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;

class Category extends CategoryData
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

    public function getServiceIds()
    {
        $services = $this->getServices();
        $service_ids = array();
        foreach ($services as $service) {
            $service_ids[] = $service->id;
        }
        return $service_ids;
    }

    public function getPlaceIds()
    {
        $place_ids = array();
        $place_has_services = $this->getPlaceHasServices();

        foreach ($place_has_services as $place_has_service) {
            $place_ids[] = $place_has_service['place_id'];
        }
        return $place_ids;
    }

    public function sql()
    {
        return "SELECT DISTINCT `place`.* 
                FROM `place_has_service`, `place`, `service` 
                WHERE `place_has_service`.`place_id`= `place`.`id` 
                AND `place_has_service`.`service_id` = `service`.`id` 
                AND `service`.`category_id` = " . $this->id . "
                AND `place`.`status` = " . Yii::$app->params['active'];
    }

    public function getList()
    {
        $sql = $this->sql();
        return Place::findBySql($sql);
    }

    public function getOneRandomPlace()
    {
        $sql = $this->sql();
        $sql .= " AND (`place`.`logo` != '' OR `place`.`logo` IS NOT NULL) ORDER BY RAND() LIMIT 1";
        return Place::findBySql($sql);
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
        $sql = $this->sql();
        $sql .= ' AND `profile_type` = ' . Yii::$app->params['PREMIUM'] . '  ORDER BY RAND() LIMIT 10';
        return Place::findBySql($sql);

    }

    public function getBasicList()
    {
        $sql = $this->sql();
        $sql .= '  ORDER BY `profile_type` <> ' . Yii::$app->params['PREMIUM'] . ', 
                 `profile_type` <> ' . Yii::$app->params['BASIC'] . ', 
                  RAND() LIMIT 6';
        return Place::findBySql($sql);
    }

    public function getFreeList()
    {
        $sql = $this->sql();
        $sql .= '  ORDER BY `profile_type` <> ' . Yii::$app->params['BASIC'] . ', 
                 `profile_type` <> ' . Yii::$app->params['FREE'] . ', 
                  RAND() LIMIT 16';
        return Place::findBySql($sql);
    }

    public function getMostViewed()
    {
        $views = $this->getViews();
        $place_ids = array();
        foreach ($views as $view) {
            $place_ids[] = $view->place_id;
        }
        return Place::find()
            ->where(['in', 'id', $place_ids])
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('FIELD(id, ' . implode(',', $place_ids) . ')'))
            ->all();
    }

    public function getOneRandomGallery()
    {
        $service_ids = $this->getServiceIds();

        /*return Gallery::find()
            ->where(['in', 'service_id', $service_ids])
            ->andWhere(['!=', 'name', ''])
            ->orderBy(new Expression('RAND()'))
            ->limit(1)
            ->all();*/
        $sql = "SELECT `gallery`.*
                FROM `gallery`, `service`
                WHERE `gallery`.`service_id` = `service`.`id`
                AND (`gallery`.`name` != '' OR `gallery`.`name` IS NOT NULL)
                AND `service`.`category_id` = " . $this->id . ' ORDER BY RAND() LIMIT 1';
        return Gallery::findBySql($sql)->all();
    }

    public function getGalleries()
    {
        $photo = array();
        $galleries = $this->getOneRandomGallery();
        foreach ($galleries as $gallery) {
            $photo[] = $gallery->name;
        }
        return Yii::$app->params['thumbnails'] . $photo[0];
    }
}