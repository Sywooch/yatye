<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event_has_tags".
 *
 * @property integer $event_id
 * @property integer $event_tag_id
 * @property string $created_at
 * @property integer $status
 * @property integer $created_by
 *
 * @property Event $event
 * @property EventTags $eventTag
 */
class EventHasTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_has_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'event_tag_id', 'status', 'created_by'], 'required'],
            [['event_id', 'event_tag_id', 'status', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['event_id', 'event_tag_id'], 'unique', 'targetAttribute' => ['event_id', 'event_tag_id'], 'message' => 'The combination of Event ID and Event Tag ID has already been taken.'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['event_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventTags::className(), 'targetAttribute' => ['event_tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => Yii::t('app', 'Event ID'),
            'event_tag_id' => Yii::t('app', 'Event Tag ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventTag()
    {
        return $this->hasOne(EventTags::className(), ['id' => 'event_tag_id']);
    }
}
