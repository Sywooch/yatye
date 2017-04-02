<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 10/9/16
 * Time: 0:30
 */

namespace backend\models\place;

use Yii;
use Exception;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $uploadedFile;
    public $isSaved = false;

    public function rules()
    {
        return [
            [['uploadedFile'], 'file', 'skipOnEmpty' => false],//, 'extensions' => 'xlsx, xls'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->uploadedFile->saveAs('imports/' . $this->uploadedFile->baseName . '.' . $this->uploadedFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public static function importExcel($inputFile)
    {
        // read the file
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            die('Error while loading input file');
        }

        // read through the file
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // loop through rows from the file
        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

            // skip file header
//            if ($row == 1) {
//                continue;
//            }

            if (!empty($rowData)) {
                self::savePlaces($rowData);
            } else {
                Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'You need to fill the excel template file provided without any changes'));
            }
        }

        return true;
    }

    private static function savePlaces($rowData)
    {

        $name = $rowData[0][0];
        $street = $rowData[0][1];
//        $neighborhood = $rowData[0][2];


        $check_place = Place::findOne(['name' => $name]);

        if (!$check_place) {

            if ($street != null || $name != null) {
                $place = new Place();
                $place->name = $name;
                $place->street = $street;
//                $place->neighborhood = $neighborhood;
                $place->status = Yii::$app->params['imported'];
                $place->profile_type = null;
                $place->save();
            }
            else {
                Yii::$app->getSession()->setFlash("fail", Yii::t('app', 'All fields are required'));
            }
        }
    }
}
