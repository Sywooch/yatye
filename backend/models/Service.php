<?php

namespace backend\models;

use Yii;
use common\models\Service as BaseService;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

class Service extends BaseService
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
                'updatedByAttribute' => false,
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'image' => 'Image',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'status' => 'Status',
            'created_by' => 'Created By',
        ];
    }


    public function rules()
    {
        return [
            [['category_id', 'name', 'slug'], 'required'],
            [['category_id', 'status', 'created_by'], 'integer'],
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


    public function getPlacesFromService()
    {
        $query = new Query();

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
            ->from('`service`, `place`, `place_service`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`id` = ' . $this->id)
//            ->andWhere('`service`.`type` = "' . $type . '"')
            ->andWhere("`service`.`status` = " . Yii::$app->params['active'])
            ->andWhere("`place`.`status` = " . Yii::$app->params['active'])
            ->groupBy('`place_service`.`place_id`')
            ->all();
//            ->orderBy('RAND()');

        return $select;

    }

    public function getCategoryName()
    {

        $category_name = NULL;
        if ($this->category_id) {
            $obj = Category::findOne($this->category_id);
            if ($obj) {
                $category_name = $obj->name;
            }
        }

        return $category_name;
    }

    public function getCategorySlug()
    {

        $category_slug = NULL;
        if ($this->category_id) {
            $obj = Category::findOne($this->category_id);
            if ($obj) {
                $category_slug = $obj->slug;
            }
        }

        return $category_slug;
    }

    public function getServiceName()
    {

        return $this->name;
    }

    public function getServiceSlug()
    {
        return $this->slug;
    }

    public function getServicesByCategoryId($category_id)
    {
        return self::find()->where(['category_id' => $category_id])->all();
    }

    public function getPlaceById($id)
    {
        return Place::findOne($id);
    }

    public function getPlaces()
    {
        $query = new Query();

        $select = $query
            ->select('`place`.`id`')
            ->addSelect('`place`.`name`')
            ->addSelect('`place`.`status`')
            ->addSelect('`place_service`.`service_id`')
            ->from('`service`, `place`, `place_service`')
            ->where('`place`.`id` = `place_service`.`place_id`')
            ->andWhere('`service`.`id` = `place_service`.`service_id`')
            ->andWhere('`service`.`id` = ' . $this->id)
            ->orderBy('`place`.`name`')->all();

        return $select;
    }

}
