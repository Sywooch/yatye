<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $place_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $birthdate
 * @property string $gender
 * @property string $avatar
 * @property string $bio
 * @property string $email
 * @property string $phone
 * @property string $facebook
 * @property string $twitter
 * @property string $google_plus
 * @property string $linkedin
 * @property string $instagram
 * @property string $created_at
 * @property string $expire_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Place $place
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'email', 'created_at'], 'required'],
            [['user_id', 'place_id', 'status'], 'integer'],
            [['birthdate', 'created_at', 'expire_at', 'updated_at'], 'safe'],
            [['bio'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'email'], 'string', 'max' => 125],
            [['gender'], 'string', 'max' => 10],
            [['avatar', 'facebook', 'twitter', 'google_plus', 'linkedin', 'instagram'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['user_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'place_id' => Yii::t('app', 'Place ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'middle_name' => Yii::t('app', 'Middle Name'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'gender' => Yii::t('app', 'Gender'),
            'avatar' => Yii::t('app', 'Avatar'),
            'bio' => Yii::t('app', 'Bio'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'google_plus' => Yii::t('app', 'Google Plus'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'instagram' => Yii::t('app', 'Instagram'),
            'created_at' => Yii::t('app', 'Created At'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
