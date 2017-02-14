<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 10/9/16
 * Time: 0:31
 */

namespace backend\models;


use yii\base\Model;

class BackupFile extends  Model
{
    public $id ;
    public $name ;
    public $size ;
    public $create_time ;
    public $modified_time ;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array(['id','name','size','create_time','modified_time'], 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name'=>'Faylın Adı',
            'size'=>'Həcmi',
            'create_time'=>'Yaradılma Tarixi',
            'modified_time'=>'Yeniləmmə Tarixi',
        );
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Backup File|Backup Files', $n);
    }
}
