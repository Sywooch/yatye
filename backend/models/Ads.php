<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 2/14/17
 * Time: 3:39 PM
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Ads as BaseAds;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Ads extends BaseAds
{
    public $image_file;
    public $period;

    public function rules()
    {

        return [
            ['image_file', 'file', 'extensions' => ['png', 'jpg', 'gif']],
            [['image_file'], 'required', 'on' => 'create'],

            [['title', 'image', 'type', 'size'], 'required'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['type', 'status', 'created_by', 'updated_by', 'size'], 'integer'],
            [['title'], 'string', 'max' => 75],
            [['image', 'url'], 'string', 'max' => 255],
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
        ];
    }

    public function beforeValidate()
    {
        $this->image = preg_replace('/\s+/', '', $this->image);
        $this->image = preg_replace('/\s+/', '', $this->image);

        return parent::beforeValidate();
    }

    public function checkImageSizes()
    {
        if ($this->size == Yii::$app->params['300x300']) {
            $width = 300;
            $height = 300;
        } elseif ($this->size == Yii::$app->params['730x300']) {
            $width = 730;
            $height = 300;
        } elseif ($this->size == Yii::$app->params['350x630']) {
            $width = 350;
            $height = 630;
        } else {
            $width = 0;
            $height = 0;
        }
        return ['width' => $width, 'height' => $height];
    }

    public function getPath()
    {
        return Yii::$app->params['ads_images'] . $this->image;
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