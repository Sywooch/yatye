<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property integer $id
 * @property string $email
 * @property integer $verified
 * @property integer $status
 * @property integer $place
 * @property integer $visitor
 * @property integer $user
 * @property string $unsubscribe_place
 * @property string $unsubscribe_visitor
 * @property string $unsubscribe_user
 * @property string $created_at
 * @property string $updated_at
 * @property integer $place_id
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'created_at'], 'required'],
            [['verified', 'status', 'place', 'visitor', 'user', 'place_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'unsubscribe_place', 'unsubscribe_visitor', 'unsubscribe_user'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'verified' => Yii::t('app', 'Verified'),
            'status' => Yii::t('app', 'Status'),
            'place' => Yii::t('app', 'Place'),
            'visitor' => Yii::t('app', 'Visitor'),
            'user' => Yii::t('app', 'User'),
            'unsubscribe_place' => Yii::t('app', 'Unsubscribe Place'),
            'unsubscribe_visitor' => Yii::t('app', 'Unsubscribe Visitor'),
            'unsubscribe_user' => Yii::t('app', 'Unsubscribe User'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'place_id' => Yii::t('app', 'Place ID'),
        ];
    }
}
