<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $introduction
 * @property string $slug
 * @property string $image
 * @property string $content
 * @property string $ip_address
 * @property integer $views
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property BlogReview[] $blogReviews
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['content'], 'string'],
            [['views', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image', 'ip_address', 'tags'], 'string', 'max' => 255],
            [['introduction'], 'string', 'max' => 500],
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
            'content' => Yii::t('app', 'Content'),
            'ip_address' => Yii::t('app', 'Ip Address'),
            'views' => Yii::t('app', 'Views'),
            'tags' => Yii::t('app', 'Tags'),
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
    public function getBlogReviews()
    {
        return $this->hasMany(BlogReview::className(), ['blog_id' => 'id']);
    }
}
