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
}