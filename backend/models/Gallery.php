<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 26/01/2016
 * Time: 18:25
 */

namespace backend\models;


use common\components\SimpleImage;
use common\helpers\GalleryHelper;
use common\helpers\ValueHelpers;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use common\models\Gallery as BaseGallery;
use yii\behaviors\BlameableBehavior;
use Yii;

class Gallery extends BaseGallery
{
    public $image = [];
    public $category_id;

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

    public function beforeValidate()
    {
        $this->path = preg_replace('/\s+/', '', $this->path);
        $this->path = preg_replace('/\s+/', '', $this->path);

        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => ['png', 'jpg', 'jpeg', 'gif'], 'maxFiles' => 50, 'maxSize' => 1024 * 1024],
            ['image', 'required', 'message' => '{attribute} can\'t be blank', 'on' => 'create'],
            [['place_id'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['created_at', 'expire_at', 'updated_at', 'service_id', 'updated_by'], 'safe'],
            [['name', 'title', 'caption'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 500],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    public function uploadImage($gallery, $place_id, $place_code)
    {
        $a = 0;
        foreach ($gallery->image as $file) {
            $a++;
            $file_name = Yii::$app->params['gallery'] . $place_code . '_' . rand() . rand() . date("Ymdhis") . '_' . $a . '.' . $file->extension;
            $path = Yii::$app->params['frontend_alias'] . $file_name;
            $file_name = preg_replace('/\s+/', '', $file_name);
            $file->saveAs($path);
            $this->place_id = $place_id;
            $this->path = $file_name;
            $this->save();
        }
    }

    public static function resizeBeforeUpload($image, $path, $max_width, $min_width, $min_heigth)
    {

        //Image manipulation class, provides cropping, resampling and canvas resize
        /*$manipulator = new ImageManipulator($tmp_name);
        $width = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        $w = $width / 2;
        $h = $height / 2;

        // our dimensions will be 200x130
        $x1 = $centreX - $w; // 200 / 2
        $y1 = $centreY - $h; // 130 / 2

        $x2 = $centreX + $w; // 200 / 2
        $y2 = $centreY + $h; // 130 / 2

        // center cropping to 200x130
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        $manipulator->save($tmp_image_path);*/


        //Get Image width and height using SimpleImage class
        $simpleImage = new SimpleImage($image);
        $width = $simpleImage->get_width();
        $height = $simpleImage->get_height();

//        $max_width = 768;
//        $min_width = 512;
//        $min_heigth = 384;


        if ($width < $min_width) {
            Yii::$app->getSession()->setFlash("fail", 'Height must be greater ' . $min_width);
            return false;
        }

        if ($height < $min_heigth) {
            Yii::$app->getSession()->setFlash("fail", 'Height must be greater ' . $min_heigth);
            return false;
        }

        if ($height > $width) {
            Yii::$app->getSession()->setFlash("fail", 'Width must be greater than height');
            return false;
        }

        if ($width > $max_width) {

            $getHeight = $height * $max_width / $width;
            $height = round($getHeight);
            $width = $max_width;

        }

        //Resize Image before upload
        $simpleImage->resize($width, $height);
        $simpleImage->save($path);
        return true;
    }


    public function uploadAndSaveImages($file, $file_name, $id){

        $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['gallery'] . $file_name;

        $thumbnail_file_name = 'tn_' . $file_name;
        $thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['thumbnail'] . $thumbnail_file_name;

        $tn_thumbnail_file_name = 'tn_' . $thumbnail_file_name;
        $tn_thumbnail_path = Yii::$app->params['frontend_alias'] . Yii::$app->params['tn_thumbnail'] . $tn_thumbnail_file_name;

        $file_name = preg_replace('/\s+/', '', $file_name);


        if (GalleryHelper::resizeBeforeUpload(
            $file->tempName,
            $path,
            Yii::$app->params['max_width_768'],
            Yii::$app->params['min_width_512'],
            Yii::$app->params['min_heigth_384']
        )) {
            if (GalleryHelper::resizeBeforeUpload(
                $file->tempName,
                $thumbnail_path,
                Yii::$app->params['max_width_490'],
                Yii::$app->params['min_width_328'],
                Yii::$app->params['min_heigth_246']
            )) {
                if (GalleryHelper::resizeBeforeUpload(
                    $file->tempName,
                    $tn_thumbnail_path,
                    Yii::$app->params['max_width_128'],
                    Yii::$app->params['min_width_96'],
                    Yii::$app->params['min_heigth_70']
                )) {
                    $this->place_id = $id;
                    $this->name = $file_name;
                    $this->status = Yii::$app->params['active'];
                    $this->save();
                }
            }
        }
    }

    public function getServiceName()
    {
        $service_name = NULL;
        if ($this->service_id) {
            $obj = Service::findOne($this->service_id);
            if ($obj) {
                $service_name = $obj->name;
            }
        }

        return $service_name;
    }

    public function getPlaceName()
    {
        $place_name = NULL;
        if ($this->place_id) {
            $obj = Place::findOne($this->place_id);
            if ($obj) {
                $place_name = $obj->name;
            }
        }

        return $place_name;
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