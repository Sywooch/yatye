<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/5/17
 * Time: 8:51 PM
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\Contract as BaseContract;
use yii\base\Exception;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;

class Contract extends BaseContract
{
    public $contract_doc;

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

    public function rules()
    {
        return [
            [['client_id', 'title'], 'required'],
            [['client_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['summary'], 'string'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['title', 'path'], 'string', 'max' => 255],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['status'], 'default', 'value' => Yii::$app->params['pending']],
            [['contract_doc'], 'file', 'extensions' => 'PDF', 'maxSize' => 1024 * 1024],

        ];
    }

    public function uploadContractFile()
    {
        $file = UploadedFile::getInstance($this, 'contract_doc');
        if ($file) {
            $file_name = rand() . rand() . date("Ymdhis") . '.' . $file->extension;
            $this->path = $file_name;
            $this->save();
            return $file;
        } else {
            return false;
        }

    }

    public function getContractFile($id)
    {
        return Yii::$app->params['frontend_alias'] . Yii::$app->params['contracts'] . $id . '/';
    }

    public function getClient()
    {
        return Client::findOne(['id' => $this->client_id])->name;
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }

    public function getPeriod() {
        $day   = 24 * 3600;

        $start_at  = strtotime($this->start_at);
        $end_at    = strtotime($this->end_at);
        $diff  = abs($end_at - $start_at);

        Yii::warning('Day : ' . $day);
        Yii::warning('Start at : ' . $day);
        Yii::warning('End at : ' . $end_at);
        Yii::warning('Diff : ' . $diff);

        $years   = floor($diff / (365*60*60*24));
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $out   = array();
        if ($years) $out[] = "$years Year" . ($years > 1 ? 's' : '');
        if ($months) $out[] = "$months Month" . ($months > 1 ? 's' : '');
        if ($days)  $out[] = "$days Day" . ($days > 1 ? 's' : '');
        return implode(', ', $out);
    }
}