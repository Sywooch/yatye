<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/25/17
 * Time: 11:48 AM
 */

namespace common\helpers;

use Yii;

class S3Helpers
{
    public static function upload($id, $type, $gallery)
    {
        $local_path = '/Applications/MAMP/htdocs/rwandaguide/frontend/web/files/uploads/gallery/';
        $file = $local_path . $gallery->name;

        $extension = explode('.', $file);
        $extension = strtolower(end($extension));
        $key = md5(uniqid()) . rand() . rand() . date("Ymdhis");
        $file_name = $key . '.' . $extension;

        $path = 'uploads/' . $type . '/' . $id . '/';
        $file_path = $path . $file_name;

        $s3 = Yii::$app->get('s3');
        $result = $s3->upload($file_path, $file);

        $gallery->updateGallery($file_name);

        return $file_name;
    }

    public static function getBucketAndPath($object, $id)
    {
        return Yii::$app->params['s3_bucket'] . Yii::$app->params[$object] . $id . '/';
    }
}