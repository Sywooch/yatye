<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/8/17
 * Time: 4:08 PM
 */

namespace backend\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\ValueHelpers;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use common\models\AboutUs as BaseAboutUs;

class AboutUs extends BaseAboutUs
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

    public function rules()
    {
        return [
            [['title', 'slug', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['slug'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
        ];

    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }
    public function getPostPicture()
    {
        return Yii::$app->params['post_images'] . $this->image;
    }

    public function getPostThumbnails()
    {
        return Yii::$app->params['post_thumbnails'] . $this->image;
    }

    public function getPostUrl()
    {
        return Yii::$app->request->baseUrl . '/about-us/' . $this->slug;
    }

    public function getLastUpdatedDate()
    {
        $post = self::findOne(['id' => $this->id]);
        return date('D d M, Y', strtotime($post->created_at));
    }

    public static function getAboutUsPosts()
    {
        return self::find()
            ->where(['status' => Yii::$app->params['active']])
            ->orderBy('created_at')
            ->all();
    }
}