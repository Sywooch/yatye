<?php
namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use dektrium\user\models\User as BaseUser;

/**
 * This is the model class for table "user"
 *
 * @property UserEvent[] $userEvents
 * @property Event[] $events
 * @property UserPlace[] $userPlaces
 * @property Place[] $places
 * @property UserProfile $userProfile
 */
class User extends BaseUser implements IdentityInterface
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEvents()
    {
        return $this->hasMany(UserEvent::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'event_id'])->viaTable('user_event', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Place::className(), ['id' => 'place_id'])->viaTable('user_place', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }
}
