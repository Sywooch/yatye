<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 4/9/17
 * Time: 8:45 PM
 */

namespace backend\models;

use backend\models\place\Place;
use Yii;
use common\models\GooglePlaces as BaseGooglePlaces;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class GooglePlaces extends BaseGooglePlaces
{
    public $location;
    public $radius;
    public $type;

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
            [['google_id', 'place_id', 'reference', 'lat', 'lng'], 'required'],
            [['lat', 'lng'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['name', 'google_id', 'place_id', 'vicinity', 'types'], 'string', 'max' => 255],
            [['reference'], 'string', 'max' => 500],
            [['place_id'], 'unique'],
            [['status'], 'default', 'value' => Yii::$app->params['inactive']],
        ];
    }

    public static function importEvents($places)
    {

        foreach ($places as $place) {
            $name = (isset($place['name'])) ? $place['name'] : '-';
            $google_id = (isset($place['id'])) ? $place['id'] : '-';
            $place_id = (isset($place['place_id'])) ? $place['place_id'] : '-';
            $reference = (isset($place['reference'])) ? $place['reference'] : '-';
            $lat = (isset($place['geometry']['location']['lat'])) ? $place['geometry']['location']['lat'] : '-';
            $lng = (isset($place['geometry']['location']['lng'])) ? $place['geometry']['location']['lng'] : '-';
            $vicinity = (isset($place['vicinity'])) ? $place['vicinity'] : '-';

            $count = (isset($place['types'])) ? $place['types'] : 0;
            $types = '';

            for ($i = 0; $i < count($count); $i++) {
                $types .= $count[$i] . ' ';
            }

            $check = GooglePlaces::findOne(['place_id' => $place_id]);

            if (empty($check)) {
                $facebook_event = new GooglePlaces();
                $facebook_event->name = $name;
                $facebook_event->google_id = $google_id;
                $facebook_event->place_id = $place_id;
                $facebook_event->reference = $reference;
                $facebook_event->lat = $lat;
                $facebook_event->lng = $lng;
                $facebook_event->vicinity = $vicinity;
                $facebook_event->types = $types;
                $facebook_event->status = Yii::$app->params['inactive'];
                $facebook_event->save(0);
            }
        }
    }

    public function saveGooglePlaces()
    {
        $event = new Place();
        $event->name = $this->name;
        $event->street = $this->vicinity;
        $event->latitude = $this->lat;
        $event->longitude = $this->lng;
        $event->status = Yii::$app->params['imported'];
        if ($event->save()) {
            return true;
        } else {
            return false;
        }
    }
}