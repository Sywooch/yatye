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
    public function sql()
    {
        return "SELECT DISTINCT `place`.* 
                FROM `place_has_service`, `place`, `service` 
                WHERE `place_has_service`.`place_id`= `place`.`id` 
                AND `place_has_service`.`service_id` = `service`.`id` 
                AND `service`.`category_id` = " . $this->id . "
                AND `service`.`status` = " . Yii::$app->params['active'] . " 
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

    public function getPlaceIds()
    {
        $placeIds = array();
        foreach ($this->getList()->all() as $place) {
            $placeIds[] = $place->id;
        }

        return $placeIds;
    }

    public function getPremiumList()
    {
        return Place::find()
            ->where(['in', 'id', $this->getPlaceIds()])
            ->andWhere(['profile_type' => Yii::$app->params['PREMIUM']])
            ->orderBy(new Expression('RAND()'));
    }

    public function getBasicList()
    {
        return Place::find()
            ->where(['in', 'id', $this->getPlaceIds()])
            ->orderBy(new Expression('`profile_type` <> ' . Yii::$app->params['PREMIUM'] . ', 
                 `profile_type` <> ' . Yii::$app->params['BASIC'] . ', 
                  RAND()'));
    }

    public function getFreeList()
    {
        return Place::find()
            ->where(['in', 'id', $this->getPlaceIds()])
            ->orderBy(new Expression('`profile_type` <> ' . Yii::$app->params['BASIC'] . ', 
                 `profile_type` <> ' . Yii::$app->params['FREE'] . ', 
                  RAND() '));
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
        $sql = "SELECT `gallery`.*
                FROM `gallery`, `service`
                WHERE `gallery`.`service_id` = `service`.`id`
                AND (`gallery`.`name` != '' OR `gallery`.`name` IS NOT NULL)
                AND `service`.`category_id` = " . $this->id . ' ORDER BY RAND() LIMIT 1';
        return Gallery::findBySql($sql)->all();
    }

    public function getGalleries()
    {
        $galleries = $this->getOneRandomGallery();

        if(!empty($galleries)){
            $photo = array();
            foreach ($galleries as $gallery) {
                $photo[] = $gallery->getPath();
            }
            return $photo[0];
        }else{
            return false;
        }
    }
}