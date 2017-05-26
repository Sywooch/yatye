<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/06/2016
 * Time: 13:04
 */

namespace common\helpers;

use backend\models\place\Gallery;
use backend\models\place\Place;
use Yii;
use common\components\SimpleImage;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class GalleryHelper
{
    public static function resizeBeforeUpload($image, $path, $max_width, $min_width, $min_height)
    {

        //Get Image width and height using SimpleImage class
        $simpleImage = new SimpleImage($image);
        $width = $simpleImage->get_width();
        $height = $simpleImage->get_height();


        if ($width < $min_width) {
            Yii::$app->getSession()->setFlash("fail", 'Height must be greater ' . $min_width);
            return false;
        }

        if ($height < $min_height) {
            Yii::$app->getSession()->setFlash("fail", 'Height must be greater ' . $min_height);
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

    public static function deleteGallery($path)
    {

        try {
            unlink($path);
        } catch (\Exception $e) {
            //error
        }
    }

    public static function uploadAds($image, $path, $min_width, $min_height)
    {
        //Get Image width and height using SimpleImage class
        $simpleImage = new SimpleImage($image);
        $width = $simpleImage->get_width();
        $height = $simpleImage->get_height();

        Yii::warning('width : ' . $width);
        Yii::warning('height : ' . $height);

        if ($width > $min_width && $height > $min_height) {
            $simpleImage->save($path);
            return true;
        } else {
            Yii::$app->getSession()->setFlash("fail", 'The dimensions of this image are too small!');
            return false;
        }
    }

    public static function uploadEvents($image, $path)
    {
        //Get Image width and height using SimpleImage class
        $simpleImage = new SimpleImage($image);
        $width = $simpleImage->get_width();
        $height = $simpleImage->get_height();

        Yii::warning('width : ' . $width);
        Yii::warning('height : ' . $height);

        if ($image && $path != null) {
            $simpleImage->save($path);
            return true;
        } else {
            Yii::$app->getSession()->setFlash("fail", 'There is an error while uploading your event image');
            return false;
        }
    }

    public static function getAllFiles()
    {
        $path = Yii::$app->params['frontend_alias'] . Yii::$app->params['gallery'];
        $all_files = FileHelper::findFiles($path);
        $all_files_ = array();

        if (!empty($all_files)) {
            for ($i = 0; $i < count($all_files); $i++) {
                $all_files_[] = substr($all_files[$i], 73);
            }
            return $all_files_;
        }
        return null;
    }

    public static function getPhotos($place)
    {
//        $id = $place->id;
        $id = 2;

        $all_files = self::getAllFiles();
        if (!empty($all_files)) {
            $photos = Gallery::findAll(['place_id' => $id]);

            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    if (in_array($photo->name, $all_files)) {
                        $file_name = S3Helpers::upload($id, 'tests', $photo);

                        if (in_array($place->logo, $all_files)) {
                            $place->saveLogo($photo, $file_name);
                        }
                    }
                }
            }
        }
    }
}