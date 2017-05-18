<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/07/2016
 * Time: 13:56
 */

namespace common\helpers;

use backend\models\Ads;
use Yii;
use yii\db\Expression;
use common\models\Cell;
use backend\models\Event;
use common\models\Sector;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use backend\models\post\Post;
use backend\models\EventTags;
use backend\models\place\Place;
use backend\models\place\Service;
use backend\models\place\Category;
use backend\models\post\PostCategory;

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
            ->andWhere(['status' => Yii::$app->params['active']])
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
            ->andWhere(['status' => Yii::$app->params['active']])
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
        if (!empty($model)) {
            return $model->getContacts();
        }
    }

    public static function getPlacesWithStatuses($status)
    {
        return Place::find()->where(['status' => $status])->count();
    }

    public static function getPlacesWithEmptyFields()
    {
        $places = Place::getPlacesWithEmptyFields();
        return [
            'descriptions' => $places['descriptions']->count(),
            'slugs' => $places['slugs']->count(),
            'logos' => $places['logos']->count(),
            'provinces' => $places['provinces']->count(),
            'districts' => $places['districts']->count(),
            'sectors' => $places['sectors']->count(),
            'cells' => $places['cells']->count(),
            'neighborhoods' => $places['neighborhoods']->count(),
            'streets' => $places['streets']->count(),
            'latitudes' => $places['latitudes']->count(),
            'longitudes' => $places['longitudes']->count(),
            'profile_types' => $places['profile_types']->count(),
        ];
    }

    public static function getPlacesWithoutContacts()
    {
        $places = Place::getPlacesWithoutContacts();
        return [
            'physical_addresses' => $places['physical_addresses']->count(),
            'po_boxes' => $places['po_boxes']->count(),
            'mob_phones' => $places['mob_phones']->count(),
            'land_lines' => $places['land_lines']->count(),
            'faxes' => $places['faxes']->count(),
            'emails' => $places['emails']->count(),
            'websites' => $places['websites']->count(),
            'skypes' => $places['skypes']->count(),
        ];
    }

    public static function getPlacesWithoutSocialMedia()
    {
        $places = Place::getPlacesWithoutSocialMedia();
        return [
            'facebook' => $places['facebook']->count(),
            'twitter' => $places['twitter']->count(),
            'instagram' => $places['instagram']->count(),
            'linkedin' => $places['linkedin']->count(),
            'pintrest' => $places['pintrest']->count(),
            'tumblr' => $places['tumblr']->count(),
            'youtube' => $places['youtube']->count(),
            'google_plus' => $places['google_plus']->count(),
            'flicklr' => $places['flicklr']->count(),
            'trip_advisor' => $places['trip_advisor']->count(),
        ];
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
            ->where(new Expression('TIMESTAMP(`end_date`,`end_time`) >= CURRENT_TIMESTAMP'))
            ->andWhere(['status' => Yii::$app->params['active']])
            ->orderBy(new Expression('`start_date`'))
            ->limit(8)
            ->all();
    }

    public static function getKeywords()
    {
//        $places = Place::findAll(['status' => Yii::$app->params['active']]);
        $categories = Category::findAll(['status' => Yii::$app->params['active']]);
        $services = Service::findAll(['status' => Yii::$app->params['active']]);
//        $posts = Post::findAll(['status' => Yii::$app->params['active']]);
//        $post_categories = PostCategory::findAll(['status' => Yii::$app->params['active']]);
//        $events = Event::findAll(['status' => Yii::$app->params['active']]);
//        $event_tags = EventTags::findAll(['status' => Yii::$app->params['active']]);

        $keywords = array();

        /*foreach ($places as $place) {
            $keywords[] = $place->name;
        }*/

        foreach ($categories as $category) {
            $keywords[] = $category->name . ' in Rwanda';
        }

        foreach ($services as $service) {
            $keywords[] = $service->name . ' in Rwanda';
        }

        /*foreach ($posts as $post) {
            $keywords[] = $post->title;
        }

        foreach ($post_categories as $post_category) {
            $keywords[] = 'Rwanda Guide - Posts - ' . $post_category->name;
        }

        foreach ($events as $event) {
            $keywords[] = 'Rwanda Guide - Events - ' . $event->name;
        }

        foreach ($event_tags as $event_tag) {
            $keywords[] = 'Rwanda - Events - ' . $event_tag->name;
        }*/

        $keywords[] = implode(",", Yii::$app->params['meta_classification']);

        return implode(",", $keywords);
    }

    public static function getPostArchives()
    {
        return Post::find()
            ->select(new Expression('COUNT(`id`) AS number, Month(`created_at`) AS month, Year(`created_at`) AS year'))
            ->groupBy(new Expression('Month(`created_at`), Year(`created_at`)'))
            ->orderBy(new Expression("STR_TO_DATE(CONCAT(month, '/', year), '%m/%Y') DESC"))
            ->asArray()
            ->all();
    }

    public static function getAds()
    {
        $ads_300x300 = Ads::find()
            ->where(['status' => Yii::$app->params['active']])
            ->andWhere(['size' => Yii::$app->params['300x300']])
            ->orderBy(new Expression('RAND()'))
            ->limit(2)
            ->all();

        $ads_730x300 = Ads::find()
            ->where(['status' => Yii::$app->params['active']])
            ->andWhere(['size' => Yii::$app->params['730x300']])
            ->orderBy(new Expression('RAND()'))
            ->all();

        $ads_350x630 = Ads::find()
            ->where(['status' => Yii::$app->params['active']])
            ->andWhere(['size' => Yii::$app->params['350x630']])
            ->orderBy(new Expression('RAND()'))
            ->all();

        return [
            '300x300' => $ads_300x300,
            '730x300' => $ads_730x300,
            '350x630' => $ads_350x630,
        ];
    }

}