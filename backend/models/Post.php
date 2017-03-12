<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/03/2016
 * Time: 15:11
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Post as BasePost;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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

    public function getPostTypeName()
    {
        $post_type_name = NULL;
        if ($this->post_type_id) {
            $obj = PostType::findOne($this->post_type_id);
            if ($obj) {
                $post_type_name = $obj->name;
            }
        }

        return $post_type_name;
    }

    public function getPostCategoryName()
    {
        $post_category_name = NULL;
        if ($this->post_category_id) {
            $obj = PostCategory::findOne($this->post_category_id);
            if ($obj) {
                $post_category_name = $obj->name;
            }
        }

        return $post_category_name;
    }
    public function getUpdatedAt(){

        $post = Post::findOne(['id'=>$this->id]);

        $d = date('d', strtotime($post->updated_at));
        $m = date('m', strtotime($post->updated_at));
        $y = date('Y', strtotime($post->updated_at));

        return $m . '/' . $d . '/' . $y;
    }
    public function getPostCategory()
    {
        return PostCategory::findOne(['id' => $this->post_category_id]);
    }

    public function getAboutUsPosts()
    {
        return Post::findAll(['post_category_id' => $this->post_category_id]);
    }

    public static function getPostsByType($post_type_id){

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