<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/04/2016
 * Time: 15:53
 */

namespace frontend\models;

use common\models\User;
use Yii;
use common\models\UserProfile as BaseUserProfile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class UserProfile extends BaseUserProfile
{

    public $image;
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
//            'blameable' => [
//                'class' => BlameableBehavior::className(),
//                'createdByAttribute' => 'created_by',
//                'updatedByAttribute' => false,
//            ],
//
//            'sluggable' => [
//                'class' => SluggableBehavior::className(),
//                'attribute' => 'name',
//
//                // In case of attribute that contains slug has different name
//                // 'slugAttribute' => 'alias',
//            ],
        ];
    }
    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxSize' => 1024 * 1024],
            [['user_id', 'first_name', 'last_name', 'email'], 'required'],
            [['user_id', 'place_id', 'status'], 'integer'],
            [['birthdate', 'created_at', 'updated_at', 'image'], 'safe'],
            [['bio'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'email'], 'string', 'max' => 125],
            [['gender'], 'string', 'max' => 10],
            [['avatar', 'facebook', 'twitter', 'google_plus', 'linkedin', 'instagram'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['user_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
}