<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/03/2016
 * Time: 15:11
 */

namespace backend\models\post;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\ValueHelpers;
use common\models\Post as BasePost;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;

class Post extends BasePost
{

    public $image_file;

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],

        ];
    }

    public function beforeValidate()
    {
        $this->image = preg_replace('/\s+/', '', $this->image);
        $this->image = preg_replace('/\s+/', '', $this->image);

        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_file'], 'safe'],
            [['image_file'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 10, 'maxSize' => 1024 * 1024],
            [['title', 'introduction', 'slug', 'post_category_id', 'post_type_id'], 'required'],
            [['content'], 'string'],
            [['post_category_id', 'post_type_id', 'views', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image', 'caption', 'ip_address'], 'string', 'max' => 255],
            [['introduction'], 'string', 'max' => 500],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
            [['post_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['post_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'introduction' => 'Introduction',
            'image' => 'Image',
            'caption' => 'Caption',
            'content' => 'Content',
            'link' => 'Link',
            'post_category_id' => 'Post Category ID',
            'post_type_id' => 'Post Type ID',
            'user_id' => 'User ID',
            'ip_address' => 'Ip Address',
            'views' => 'Views',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public function getPostPicture()
    {
        return Yii::$app->params['post_images'] . $this->image;
    }

    public function getPostThumbnails()
    {
        return Yii::$app->params['post_thumbnails'] . $this->image;
    }

    public function getPostCategory()
    {
        return PostCategory::findOne($this->post_category_id);
    }

    public function getPostCategoryName()
    {
        return $this->getPostCategory()->name;
    }

    public function getPostCategoryUrl()
    {
        return Yii::$app->request->baseUrl . '/post-details/' . $this->slug;
    }

    public function getPostUrl()
    {
        return Yii::$app->request->baseUrl . '/post-category/' . $this->getPostCategory()->slug;
    }

    public function getPostType()
    {
        return $this->getPostCategory()->getPostType();
    }

    public function getPostTypeName()
    {
        return $this->getPostCategory()->getPostTypeName();
    }

    public function getPostTypeUrl()
    {
        return $this->getPostCategory()->getPostTypeUrl();
    }

    public function getLastUpdatedDate()
    {
        $post = Post::findOne(['id' => $this->id]);
        return date('D d M, Y', strtotime($post->updated_at));
    }

    public function getAboutUsPosts()
    {
        return Post::findAll(['post_category_id' => $this->post_category_id]);
    }

    public static function getPostsByType($post_type_id)
    {

        return Post::find()
            ->where(['status' => Yii::$app->params['active'], 'post_type_id' => $post_type_id])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(3)
            ->all();
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }
}