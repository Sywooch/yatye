<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 08/12/2016
 * Time: 22:27
 */

namespace frontend\models;



use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\ValueHelpers;
use common\models\Enquiry as BaseEnquiry;

class Enquiry extends BaseEnquiry
{
    public function rules()
    {
        return [
            [['place_id', 'name', 'email', 'subject', 'message'], 'required'],
            [['place_id', 'status'], 'integer'],
            [['message'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'subject', 'ip_address'], 'string', 'max' => 255],
            ['email', 'email'],
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
        ];
    }

    public static function saveEnquiry($id, $contact_form)
    {
        $enquiry = new Enquiry();
        $enquiry->place_id = $id;
        $enquiry->name = $contact_form->name;
        $enquiry->email = $contact_form->email;
        $enquiry->subject = $contact_form->subject;
        $enquiry->message = $contact_form->body;
        $enquiry->ip_address = Yii::$app->request->getUserIP();
        $enquiry->save();
    }

    public function getPlaceName()
    {
        return Place::findOne($this->place_id)->name;
    }
    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }
}