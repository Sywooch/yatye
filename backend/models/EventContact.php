<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 04/01/2017
 * Time: 16:51
 */

namespace backend\models;

use common\helpers\ValueHelpers;
use Yii;
use common\models\EventContact as BaseEventContact;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class EventContact extends BaseEventContact
{
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

    public function rules()
    {
        return [
            [['event_id', 'type', 'name'], 'required'],
            [['event_id', 'type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'person'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => Yii::$app->params['active']],
        ];
    }

    public function getContactTypes()
    {
        if ($this->type == Yii::$app->params['PHYSICAL_ADDRESS']):
            $contact_type = Yii::t('app', 'Physical address');
        elseif ($this->type == Yii::$app->params['PO_BOX']):
            $contact_type = Yii::t('app', 'P.O Box');
        elseif ($this->type == Yii::$app->params['MOB_PHONE']):
            $contact_type = Yii::t('app', 'Mobile phone number');
        elseif ($this->type == Yii::$app->params['LAND_LINE']):
            $contact_type = Yii::t('app', 'Land line phone number');
        elseif ($this->type == Yii::$app->params['FAX']):
            $contact_type = Yii::t('app', 'Fax number');
        elseif ($this->type == Yii::$app->params['EMAIL']):
            $contact_type = Yii::t('app', 'Email address');
        elseif ($this->type == Yii::$app->params['WEBSITE']):
            $contact_type = Yii::t('app', 'Website');
        elseif ($this->type == Yii::$app->params['WEBSITE']):
            $contact_type = Yii::t('app', 'Website');
        else:
            $contact_type = Yii::t('app', 'Not set');
        endif;

        return $contact_type;
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