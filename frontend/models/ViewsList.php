<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/06/2016
 * Time: 19:30
 */

namespace frontend\models;

use Yii;
use common\models\ViewsList as BaseViewsList;
use yii\db\ActiveRecord;
use yii\db\Expression;

class ViewsList extends BaseViewsList
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}