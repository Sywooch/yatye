<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "place_has_another".
 *
 * @property integer $place_id
 * @property integer $other_place_id
 * @property string $created_at
 */
class PlaceHasAnother extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_has_another';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'other_place_id'], 'required'],
            [['place_id', 'other_place_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'place_id' => Yii::t('app', 'Place ID'),
            'other_place_id' => Yii::t('app', 'Other Place ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
