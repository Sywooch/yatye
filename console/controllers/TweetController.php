<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 01/07/2016
 * Time: 17:09
 */

namespace console\controllers;

use Yii;
use console\components\twitterbot\TwitterOAuth;

class TweetController
{

    public function actionIndex(){
        $twitter = new TwitterOAuth(Yii::$app->params['CONSUMER_KEY'], Yii::$app->params['CONSUMER_SECRET'], Yii::$app->params['ACCESS_TOKEN'], Yii::$app->params['ACCESS_TOKEN_SECRET']);
        $twitter->host = "https://api.twitter.com/1.1/";
        $search = $twitter->get('search', array('q' => 'search key word', 'rpp' => 5));

        $twitter->host = "https://api.twitter.com/1.1/";
        foreach($search->results as $tweet) {
            $status = 'RT @'.$tweet->from_user.' '.$tweet->text;
            if(strlen($status) > 140) $status = substr($status, 0, 139);
            $twitter->post('statuses/update', array('status' => $status));
        }
    }
}