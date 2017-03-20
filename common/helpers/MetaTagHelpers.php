<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 1:26 PM
 */

namespace common\helpers;

use Yii;

class MetaTagHelpers
{

    public static function registerMetaTag($title, $description, $image, $url)
    {
        /*Recommended Meta Tags*/
//        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $description]);
//        Yii::$app->view->registerMetaTag(['name' => 'subject', 'content' => $description]);
//        Yii::$app->view->registerMetaTag(['name' => 'abstract', 'content' => $description]);

        /*Open Graph data*/
        Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => $url]);
        Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $title]);
        Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $description]);
        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => $image]);
        Yii::$app->view->registerMetaTag(['property' => 'fb:app_id', 'content' => '1569960559930538']);

        /*Schema.org markup for Google+*/
        Yii::$app->view->registerMetaTag(['itemprop' => 'description', 'content' => $description]);
        Yii::$app->view->registerMetaTag(['itemprop' => 'image', 'content' => $image]);
        Yii::$app->view->registerMetaTag(['itemprop' => 'name', 'content' => $title]);

        /*Twitter Card data*/
        Yii::$app->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:site', 'content' => Yii::$app->params['meta_twitter_id']]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:creator', 'content' => Yii::$app->params['meta_twitter_id']]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:title', 'content' => $title]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:description', 'content' => $description]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:image:src', 'content' => $image]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:image:alt', 'content' => $title]);
        Yii::$app->view->registerMetaTag(['name' => 'twitter:domain', 'content' => 'rwandaguide.info']);

    }
}