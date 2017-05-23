<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $introduction
 * @property string $slug
 * @property string $image
 * @property string $caption
 * @property string $content
 * @property integer $post_category_id
 * @property integer $post_type_id
 * @property string $ip_address
 * @property integer $views
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property PostCategory $postCategory
 * @property PostReview[] $postReviews
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'introduction', 'slug', 'post_category_id', 'post_type_id', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['post_category_id', 'post_type_id', 'views', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image', 'caption', 'ip_address'], 'string', 'max' => 255],
            [['introduction'], 'string', 'max' => 500],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['post_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'introduction' => Yii::t('app', 'Introduction'),
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'caption' => Yii::t('app', 'Caption'),
            'content' => Yii::t('app', 'Content'),
            'post_category_id' => Yii::t('app', 'Post Category ID'),
            'post_type_id' => Yii::t('app', 'Post Type ID'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'views' => Yii::t('app', 'Views'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'post_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostReviews()
    {
        return $this->hasMany(PostReview::className(), ['post_id' => 'id']);
    }
}
