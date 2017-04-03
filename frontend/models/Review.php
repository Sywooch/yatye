<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 21/05/2016
 * Time: 15:09
 */

namespace frontend\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\models\Review as BaseReview;

class Review extends BaseReview
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
            [['place_id', 'full_name', 'email', 'comment'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'email'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 125],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }
}