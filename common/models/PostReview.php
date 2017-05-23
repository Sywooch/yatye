<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_review".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $full_name
 * @property string $email
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property string $ip_address
 * @property integer $status
 *
 * @property Post $post
 */
class PostReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'full_name', 'email', 'comment', 'created_at', 'ip_address'], 'required'],
            [['post_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'email'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 125],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'full_name' => 'Full Name',
            'email' => 'Email',
            'comment' => 'Comment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ip_address' => 'Ip Address',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
