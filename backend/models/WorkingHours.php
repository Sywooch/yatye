<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/01/2016
 * Time: 18:03
 */

namespace backend\models;

use Yii;
use common\models\WorkingHours as BaseWorkingHours;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class WorkingHours extends BaseWorkingHours
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
        ];
    }
}