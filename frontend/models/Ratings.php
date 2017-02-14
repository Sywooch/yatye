<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 08/02/2016
 * Time: 19:54
 */

namespace frontend\models;

use Yii;
use common\models\Ratings as BaseRatings;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class Ratings extends BaseRatings
{
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
        ];
    }

    public function beforeValidate()
    {
        $this->ratings = (double)$this->ratings;
        $this->place_id = (int)$this->place_id;
    }

    public function showAverageRating($place_id)
    {

        $averageRating = $this->getAverageRating($place_id);


//        echo StarRating::widget([
//            'name' => 'rating_' . $averageRating,
//            'value' => $averageRating,
//            'disabled' => true,
//            'pluginOptions' => [
//                'size' => 'xs',
//                'stars' => 5,
//                'min' => 0,
//                'max' => 5,
//                'step' => 0.5,
//                // 'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
//                //'defaultCaption' => '{rating} hearts',
//                'starCaptions' => []
//            ]
//
//        ]);
        return $averageRating;
    }

    public function getAverageRating($place_id)
    {

        $get_ratings = Ratings::find()->asArray()
            ->where(['place_id' => $place_id])
            ->all();

        $ratings = ArrayHelper::map($get_ratings, 'id', 'ratings');

        $ratingsSum = array_sum($ratings);

        $ratingsCount = count($ratings);

        if ($ratingsCount) {

            $averageRating = $ratingsSum / $ratingsCount;

        } else {

            $averageRating = 0;
        }

        return $averageRating;
    }
}