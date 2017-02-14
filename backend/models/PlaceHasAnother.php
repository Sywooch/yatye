<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 31/07/2016
 * Time: 11:31
 */

namespace backend\models;

use Yii;
use common\models\PlaceHasAnother as BasePlaceHasAnother;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class PlaceHasAnother extends BasePlaceHasAnother
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

//            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    public static function getAvailableOtherPlaces($place_id)
    {

        $subQuery = (new Query())
            ->select('DISTINCT `place`.`id`')
            ->from('`place_has_another`, `place`')
            ->where('`place_has_another`.`place_id`=' . $place_id)
            ->andWhere('`place_has_another`.`other_place_id` = `place`.`id`')
            ->andWhere('`place`.`status` =' . Yii::$app->params['active'])
            ->all();

        return ArrayHelper::map(Place::find()->where(['not in', 'id' , $subQuery])
            ->andWhere(['status'=>Yii::$app->params['active']])
            ->all(), 'id', 'name');
    }
}