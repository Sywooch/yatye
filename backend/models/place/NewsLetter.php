<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 09/12/2016
 * Time: 22:56
 */

namespace backend\models\place;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\helpers\EmailHelper;
use common\helpers\ValueHelpers;
use yii\behaviors\BlameableBehavior;
use common\models\NewsLetter as BaseNewsLetter;

class NewsLetter extends BaseNewsLetter
{
    public function rules()
    {
        return [
            [['subject', 'message', 'type'], 'required'],
            [['message'], 'string'],
            [['send_at', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['subject', 'attachment'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10],
            [['status'], 'default', 'value' => Yii::$app->params['draft']],
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
                'updatedByAttribute' => false,
            ],
        ];
    }

    public function sendNewsLetter()
    {
        $query = Subscription::find(); //->where(['status' => 1]);

        if ($this->type == 'visitors') {
            $subscribers = $query->where(['visitor' => 1])->all();
        } elseif ($this->type == 'places') {
            $subscribers = $query->where(['place' => 1])->all();
        } elseif ($this->type == 'users') {
            $subscribers = $query->where(['user' => 1])->all();
        } elseif ($this->type == 'all') {
            $subscribers = $query->all();
        }

        if (!empty($subscribers)) {
            foreach ($subscribers as $subscriber) {


                if(!is_null($subscriber->place_id) && $this->type == 'places'){
                    $places = Place::findAll(['id' => $subscriber->place_id]);

                    if (!empty($places)) {
                        foreach ($places as $place) {

                            if (EmailHelper::validEmail($subscriber->email)) {
                                $send = EmailHelper::sendNewsLetterEmail($subscriber, $this, $place);
                                if ($send) {
                                    $this->status = Yii::$app->params['sent'];
                                    $this->save();
                                } else {
                                    return false;
                                }
                            }
                        }
                    }
                } elseif (EmailHelper::validEmail($subscriber->email)) {
                    $send = EmailHelper::sendNewsLetterEmail($subscriber, $this);
                    if ($send) {
                        $this->status = Yii::$app->params['sent'];
                        $this->save();
                    } else {
                        return false;
                    }
                }
            }
        }
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