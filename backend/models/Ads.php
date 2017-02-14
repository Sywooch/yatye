<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 2/14/17
 * Time: 3:39 PM
 */

namespace backend\models;

use Yii;
use common\models\Ads as BaseAds;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Ads extends BaseAds
{
    public function rules()
    {
        return [
            [['title', 'slug', 'banner', 'type'], 'required'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 75],
            [['banner'], 'string', 'max' => 255],
            [['caption'], 'string', 'max' => 125],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
        ];
    }

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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],
        ];
    }
}