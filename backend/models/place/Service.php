<?php

namespace backend\models\place;

use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\ValueHelpers;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

class Service extends ServiceData
{
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
                'updatedByAttribute' => 'updated_by',
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['category_id', 'name', 'slug'], 'required'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 125],
            [['slug', 'image'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['type'], 'default', 'value' => 1],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }


    public function getPlaceServices()
    {
        return (new Query())
            ->select('DISTINCT `place_service`.`place_id`')
            ->from('`service`, `place_service`')
            ->where('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`id` = ' . $this->id)
//            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
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
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('`profile_type` <> '
                . Yii::$app->params['PREMIUM'] . ', `profile_type` <> '
                . Yii::$app->params['BASIC'] . ', `profile_type` <> '
                . Yii::$app->params['FREE'] . ', RAND()'));
    }

    public function getPlaces()
    {
        $place_ids = $this->getPlaceIds();
        return Place::find()
            ->where(['in', 'id', $place_ids]);
    }

    public function getCategoryName()
    {
        return Category::findOne($this->category_id)->name;
    }

    public function getCategorySlug()
    {
        return Category::findOne($this->category_id)->slug;
    }

    public function getServicesByCategoryId($category_id)
    {
        return self::find()
            ->where(['category_id' => $category_id])
            ->orderBy(new Expression('`status` <> ' . Yii::$app->params['active'] . ', `name`'))
            ->all();
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
