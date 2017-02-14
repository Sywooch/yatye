<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 10/07/2016
 * Time: 03:46
 */

namespace frontend\models;

use backend\models\Blog;
use Yii;
use common\models\BlogReview as BaseBlogReview;
use yii\db\ActiveRecord;
use yii\db\Expression;

class BlogReview extends BaseBlogReview
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
        ];
    }

    public function rules()
    {
        return [
            [['blog_id', 'full_name', 'email', 'comment'], 'required'],
            [['blog_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['full_name', 'email'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 125],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

}