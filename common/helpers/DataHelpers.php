<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/07/2016
 * Time: 13:56
 */

namespace common\helpers;

use backend\models\Category;
use backend\models\Event;
use backend\models\EventTags;
use common\models\Province;
use Yii;
use backend\models\Place;
use backend\models\Post;
use backend\models\PostCategory;
use backend\models\Service;
use common\models\Cell;
use common\models\District;
use common\models\Sector;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DataHelpers
{

    public static function getServices($category_id)
    {
        return Service::find()
            ->where(['category_id' => $category_id])
            ->andWhere(['status' => Yii::$app->params['active']])
            ->select(['id', 'name'])->orderBy('name')
            ->asArray()
            ->all();
    }

    public static function getDistricts($province_id)
    {
        return District::find()
            ->where(['province_id' => $province_id])
            ->select(['id', 'name'])
            ->orderBy('name')
            ->asArray()
            ->all();
    }

    public static function getSectors($district_id)
    {
        return Sector::find()
            ->where(['district_id' => $district_id])
            ->select(['id', 'name'])
            ->orderBy('name')
            ->asArray()
            ->all();
    }

    public static function getCells($sector_id)
    {
        return Cell::find()
            ->where(['sector_id' => $sector_id])
            ->select(['id', 'name'])
            ->orderBy('name')
            ->asArray()
            ->all();
    }

    public static function getPostCategories($post_type_id)
    {
        return PostCategory::find()
            ->where(['post_type_id' => $post_type_id])
            ->select(['id', 'name'])
            ->orderBy('name')
            ->asArray()
            ->all();
    }

    public static function getProvinces()
    {
        return Province::find()
            ->orderBy(new Expression('RAND()'))
            ->all();
    }

    public static function getAllCategories()
    {
        return Category::find()
            ->where(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('RAND()'))
            ->all();
    }

    public static function getAllPostCategories()
    {
        return PostCategory::find()->where(['status' => Yii::$app->params['active']])->orderBy(new Expression('RAND()'))->all();
    }

    public static function getAllServices()
    {
        return Service::find()->where(['status' => Yii::$app->params['active']])->orderBy(new Expression('RAND()'))->all();
    }

    public static function getServicesByCategoryId($category_id)
    {
        return Service::find()->where(['category_id' => $category_id, 'status' => Yii::$app->params['active']])->all();
    }

    public static function getPostsByPostCategoryId($post_category_id)
    {
        return Post::find()->where(['post_category_id' => $post_category_id, 'status' => Yii::$app->params['active']])->orderBy(new Expression('updated_at DESC'))->all();
    }

    public static function getPlacesInArray()
    {
        return ArrayHelper::map(Place::find()
            ->where(['status' => Yii::$app->params['pending']])
            ->orderBy(new Expression('updated_at ASC'))
            ->limit(30)
            ->all(), 'id', 'name');
    }

    public static function getPlacesInArray1()
    {
        return ArrayHelper::map(Place::find()
            ->where(['main' => 0])
            ->where(['status' => Yii::$app->params['active']])
            ->orderBy('id')
            ->limit(10)
            ->all(), 'id', 'name');
    }

    public static function getPlaceById($id)
    {
        return Place::findOne($id);
    }

    public static function getPlaceContacts($place_id)
    {
        $model = Place::findOne(['id' => $place_id]);

        if ($model) {
            return $model->getContacts();
        }

    }

    public static function getPlacesWithStatuses($status)
    {
        return Place::find()->where(['status' => $status])->count();
    }

    public static function getPlace()
    {
        return new Place();
    }

    public static function getAllPlaces()
    {
        return Place::find()->all();
    }

    public static function getUpcomingEvents()
    {
        return Event::find()
            ->where(new Expression('`start_date` >= CURRENT_TIMESTAMP'))
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('`start_date`'))
            ->limit(8)
            ->all();
    }

    public static function getKeywords()
    {
        $places = Place::findAll(['status' => Yii::$app->params['active']]);
        $categories = Category::findAll(['status' => Yii::$app->params['active']]);
        $services = Service::findAll(['status' => Yii::$app->params['active']]);
        $posts = Post::findAll(['status' => Yii::$app->params['active']]);
        $post_categories = PostCategory::findAll(['status' => Yii::$app->params['active']]);
        $events = Event::findAll(['status' => Yii::$app->params['active']]);
        $event_tags = EventTags::findAll(['status' => Yii::$app->params['active']]);

        $keywords = array();

        foreach ($places as $place) {
//            $keywords[] = $place->name;
        }

        foreach ($categories as $category) {
            $keywords[] = $category->name . ' in Rwanda';
        }

        foreach ($services as $service) {
            $keywords[] = $service->name . ' in Rwanda';
        }

        foreach ($posts as $post) {
//            $keywords[] = $post->title;
        }

        foreach ($post_categories as $post_category) {
//            $keywords[] = 'Rwanda Guide - Posts - ' . $post_category->name;
        }

        foreach ($events as $event) {
//            $keywords[] = 'Rwanda Guide - Events - ' . $event->name;
        }

        foreach ($event_tags as $event_tag) {
//            $keywords[] = 'Rwanda - Events - ' . $event_tag->name;
        }

        $keywords[] = implode(",", Yii::$app->params['meta_classification']);

        return implode(",", $keywords);
    }

}