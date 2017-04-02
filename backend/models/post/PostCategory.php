<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 16/03/2016
 * Time: 15:19
 */

namespace backend\models\post;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\ValueHelpers;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\models\PostCategory as BasePostCategory;

class PostCategory extends BasePostCategory
{
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
                'updatedByAttribute' => false,
            ],

            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',

                // In case of attribute that contains slug has different name
                // 'slugAttribute' => 'alias',
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_type_id', 'name', 'slug'], 'required'],
            [['post_type_id', 'status', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
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
            'name' => 'Post Category Name',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Upated At',
            'status' => 'Status',
            'created_by' => 'Created By',
        ];
    }

    public function getPosts()
    {
        return Post::find()
            ->where(['post_category_id' => $this->id, 'status' => Yii::$app->params['active']])
            ->orderBy(new Expression('updated_at DESC'));
    }

    public function getPostType()
    {
        return PostType::findOne($this->post_type_id);
    }

    public function getPostTypeName()
    {
        return $this->getPostType()->name;
    }

    public function getPostTypeUrl()
    {
        return Yii::$app->request->baseUrl . '/articles/' . $this->getPostType()->slug;
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