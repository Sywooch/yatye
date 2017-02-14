<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 16:51
 */

namespace backend\models;

use Yii;
use common\models\EventHasTags as BaseEventHasTags;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class EventHasTags extends BaseEventHasTags
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['event_id', 'event_tag_id'], 'required'],
            [['event_id', 'event_tag_id', 'status', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
        ];
    }

    public static function getNotTags($event_id)
    {

        $subQuery = (new Query())
            ->select('DISTINCT `event_tags`.`id`')
            ->from('`event_has_tags`, `event_tags`')
            ->where('`event_has_tags`.`event_id`=' . $event_id)
            ->andWhere('`event_has_tags`.`event_tag_id` = `event_tags`.`id`')
            ->andWhere('`event_tags`.`status` =' . Yii::$app->params['active'])
            ->all();

        return ArrayHelper::map(EventTags::find()->where(['not in', 'id' , $subQuery])
            ->andWhere(['status'=>Yii::$app->params['active']])
            ->all(), 'id', 'name');
    }
}