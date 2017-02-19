<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 12/06/2016
 * Time: 13:04
 */

namespace common\helpers;

use common\components\SimpleImage;
use Yii;

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

        if ($width == $min_width && $height == $min_height) {
            $simpleImage->save($path);
            return true;
        } else {
            Yii::$app->getSession()->setFlash("fail", 'Please upload the exact dimensions');
            return false;
        }
    }
}