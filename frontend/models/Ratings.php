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
    public $ratings;

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

    public function rules()
    {
        return [
            [['place_id'], 'required'],
            [['place_id', 'average', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['place_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
            [['average'], 'default', 'value' => 0],
        ];
    }

    public function saveAverage()
    {
        $ratings_list = RatingsList::findAll(['rating_id' => $this->id]);
        $ratings = ArrayHelper::map($ratings_list, 'id', 'ratings');
        $ratings_sum = array_sum($ratings);
        $ratings_count = count($ratings);

        if ($ratings_count > 0) {
            $average = $ratings_sum / $ratings_count;
        } else {
            $average = 0;
        }

        $this->average = round($average);
        $this->save();
        Yii::info('average : ' . $this->average);
    }
}