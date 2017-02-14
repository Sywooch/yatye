<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/01/2016
 * Time: 21:47
 */

namespace backend\models;

use common\models\PlaceService as BasePlaceService;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class PlaceService extends BasePlaceService
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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

    public function rules()
    {
        return [
            [['place_id', 'service_id'], 'required'],
            [['place_id', 'service_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['place_id'], 'unique'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    public static function getNotPlaceServices($place_id)
    {

        $subQuery = (new Query())
            ->select('DISTINCT `service`.`id`')
            ->from('`place_service`, `service`')
            ->where('`place_service`.`place_id`=' . $place_id)
            ->andWhere('`place_service`.`service_id` = `service`.`id`')
            ->andWhere('`service`.`status` =' . Yii::$app->params['active'])
            ->all();

        return ArrayHelper::map(Service::find()->where(['not in', 'id' , $subQuery])
            ->andWhere(['status'=>Yii::$app->params['active']])
            ->all(), 'id', 'name');
    }

    public static function getNotServicePlaces($service_id)
    {
        $subQuery = (new Query())
            ->select('DISTINCT `place`.`id`')
            ->from('`place_service`, `place`')
            ->where('`place_service`.`service_id`=' . $service_id)
//            ->where('`place_service`.`service_id`= 5')
            ->andWhere('`place_service`.`place_id` = `place`.`id`')
            ->andWhere('`place`.`status` =' . Yii::$app->params['active'])
            ->all();

        return ArrayHelper::map(Place::find()->where(['not in', 'id' , $subQuery])
            ->andWhere(['status'=>Yii::$app->params['active']])
            ->all(), 'id', 'name');
    }
}