<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/01/2016
 * Time: 18:03
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\WorkingHours as BaseWorkingHours;
use yii\behaviors\BlameableBehavior;
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
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['place_id', 'day'], 'required'],
            [['place_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['opening_time', 'closing_time', 'created_at', 'updated_at'], 'safe'],
            [['closed'], 'string'],
            [['day'], 'string', 'max' => 20],
            [['place_id', 'day'], 'unique', 'targetAttribute' => ['place_id', 'day'], 'message' => 'The combination of Place ID and Day has already been taken.'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }
}