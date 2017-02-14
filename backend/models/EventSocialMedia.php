<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 16:58
 */

namespace backend\models;

use Yii;
use common\models\EventSocialMedia as BaseEventSocialMedia;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class EventSocialMedia extends BaseEventSocialMedia
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
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
        ];
    }

    public function rules()
    {
        return [
            [['event_id', 'type', 'name'], 'required'],
            [['event_id', 'type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 125],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
        ];
    }

    public function getSocialTypes(){

        if ($this->type == Yii::$app->params['FACEBOOK']):
            $social_type = Yii::t('app', 'Facebook');
        elseif ($this->type == Yii::$app->params['TWITTER']):
            $social_type = Yii::t('app', 'Twitter');
        elseif ($this->type == Yii::$app->params['INSTAGRAM']):
            $social_type = Yii::t('app', 'Instagram');
        elseif ($this->type == Yii::$app->params['LINKEDIN']):
            $social_type = Yii::t('app', 'Linkedin');
        elseif ($this->type == Yii::$app->params['PINTREST']):
            $social_type = Yii::t('app', 'Pintrest');
        elseif ($this->type == Yii::$app->params['TUMBLR']):
            $social_type = Yii::t('app', 'Tumblr');
        elseif ($this->type == Yii::$app->params['YOUTUBE']):
            $social_type = Yii::t('app', 'Youtube');
        elseif ($this->type == Yii::$app->params['GOOGLE_PLUS']):
            $social_type = Yii::t('app', 'Google Plus');
        elseif ($this->type == Yii::$app->params['FLICKLR']):
            $social_type = Yii::t('app', 'Flicklr');
        elseif ($this->type == Yii::$app->params['TRIPADVISOR']):
            $social_type = Yii::t('app', 'Trip Advisor');
        else:
            $social_type = Yii::t('app', 'Not set');
        endif;

        return $social_type;
    }
}