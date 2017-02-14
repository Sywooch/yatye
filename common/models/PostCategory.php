<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_category".
 *
 * @property integer $id
 * @property integer $post_type_id
 * @property string $name
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $created_by
 *
 * @property Post[] $posts
 * @property PostType $postType
 */
class PostCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_type_id', 'name', 'slug', 'created_at'], 'required'],
            [['post_type_id', 'status', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['post_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostType::className(), 'targetAttribute' => ['post_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_type_id' => 'Post Type ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['post_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostType()
    {
        return $this->hasOne(PostType::className(), ['id' => 'post_type_id']);
    }
}
