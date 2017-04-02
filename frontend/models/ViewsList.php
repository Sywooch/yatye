<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 27/06/2016
 * Time: 19:30
 */

namespace frontend\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use common\models\ViewsList as BaseViewsList;


class ViewsList extends BaseViewsList
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['views_id', 'ip_address'], 'required'],
            [['views_id'], 'integer'],
            [['created_at'], 'safe'],
            [['ip_address'], 'string', 'max' => 255],
            [['views_id'], 'exist', 'skipOnError' => true, 'targetClass' => Views::className(), 'targetAttribute' => ['views_id' => 'id']],
        ];
    }
}