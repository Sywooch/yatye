<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_review".
 *
 * @property integer $id
 * @property integer $blog_id
 * @property string $full_name
 * @property string $email
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 * @property integer $status
 *
 * @property Blog $blog
 */
class BlogReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'full_name', 'email', 'comment', 'created_at', 'ip_address'], 'required'],
            [['blog_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'email'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 125],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'blog_id' => Yii::t('app', 'Blog ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'email' => Yii::t('app', 'Email'),
            'comment' => Yii::t('app', 'Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }
}
