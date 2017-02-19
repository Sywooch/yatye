<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 2/14/17
 * Time: 3:39 PM
 */

namespace backend\models;

use Yii;
use common\models\Ads as BaseAds;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Ads extends BaseAds
{
    public $image_file;

    public function rules()
    {

        return [
            ['image_file', 'file', 'extensions' => ['png', 'jpg', 'gif']],
            [['image_file'], 'required', 'on' => 'create'],

            [['title', 'slug', 'type', 'status', 'size'], 'required'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'created_by', 'updated_by', 'size'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 75],
            [['image', 'url'], 'string', 'max' => 255],
            [['caption'], 'string', 'max' => 125],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
        ];
    }

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

    public function checkImageSizes($model)
    {

        if ($model->size == Yii::$app->params['468x60']) {
            $width = 468;
            $height = 60;
        } elseif ($model->size == Yii::$app->params['840x120']) {
            $width = 840;
            $height = 120;
        } elseif ($model->size == Yii::$app->params['250x250']) {
            $width = 250;
            $height = 250;
        } elseif ($model->size == Yii::$app->params['260x400']) {
            $width = 260;
            $height = 400;
        } elseif ($model->size == Yii::$app->params['180x150']) {
            $width = 180;
            $height = 150;
        } elseif ($model->size == Yii::$app->params['240x200']) {
            $width = 240;
            $height = 200;
        } else {
            $width = 0;
            $height = 0;
        }

        return ['width' => $width, 'height' => $height];
    }

    public static function getAds()
    {
        $query = self::find();
        $ads_468x60 = $query->where(['size' => Yii::$app->params['468x60']])->orderBy(new Expression('RAND()'))->limit(1)->all();
        $ads_840x120 = $query->where(['size' => Yii::$app->params['840x120']])->orderBy(new Expression('RAND()'))->limit(1)->all();
        $ads_250x250 = $query->where(['size' => Yii::$app->params['250x250']])->orderBy(new Expression('RAND()'))->limit(1)->all();
        $ads_260x400 = $query->where(['size' => Yii::$app->params['260x400']])->orderBy(new Expression('RAND()'))->limit(1)->all();
        $ads_180x150 = $query->where(['size' => Yii::$app->params['180x150']])->orderBy(new Expression('RAND()'))->limit(1)->all();
        $ads_240x200 = $query->where(['size' => Yii::$app->params['240x200']])->orderBy(new Expression('RAND()'))->limit(1)->all();

        return [
            '468x60' => $ads_468x60,
            '840x120' => $ads_840x120,
            '250x250' => $ads_250x250,
            '260x400' => $ads_260x400,
            '180x150' => $ads_180x150,
            '240x200' => $ads_240x200,
        ];
    }


}