<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/22/17
 * Time: 11:35 PM
 */

namespace frontend\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\models\RatingsList as BaseRatingsList;

class RatingsList extends BaseRatingsList
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

    public function rules()
    {
        return [
            [['rating_id', 'ratings', 'ip_address'], 'required'],
            [['rating_id', 'ratings'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 255],
            [['rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ratings::className(), 'targetAttribute' => ['rating_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {
        $this->rating = (double)$this->rating;
        $this->rating_id = (int)$this->rating_id;

        return parent::beforeValidate();
    }


}