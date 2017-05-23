<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_letter".
 *
 * @property integer $id
 * @property string $subject
 * @property string $message
 * @property string $type
 * @property string $send_at
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $attachment
 * @property integer $status
 */
class NewsLetter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_letter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'message', 'type', 'created_at', 'created_by', 'updated_by', 'status'], 'required'],
            [['message'], 'string'],
            [['send_at', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['subject', 'attachment'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'message' => Yii::t('app', 'Message'),
            'type' => Yii::t('app', 'Type'),
            'send_at' => Yii::t('app', 'Send At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'attachment' => Yii::t('app', 'Attachment'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
