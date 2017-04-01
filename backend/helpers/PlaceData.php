<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/22/17
 * Time: 10:08 PM
 */

namespace backend\helpers;



use backend\models\Contact;
use backend\models\Gallery;
use backend\models\Place;
use Yii;
use common\models\Cell;
use common\models\District;
use common\models\Province;
use common\models\Sector;
use common\helpers\ValueHelpers;
use frontend\models\Ratings;
use frontend\models\Views;
use common\models\Place as BasePlace;
use yii\db\Expression;

class PlaceData extends BasePlace
{
    public function getLogo()
    {
        return Yii::$app->params['galleries'] . $this->logo;
    }

    public function getThumbnailLogo()
    {
        return ($this->logo != null) ? Yii::$app->params['thumbnails'] . $this->logo : Yii::$app->params['pragmaticmates-logo-jpg'];
    }

    public function getViews()
    {
        return Views::findOne(['place_id' => $this->id, 'status' => Yii::$app->params['active']])->views;
    }

    public function getStatus()
    {
        return ValueHelpers::getStatus($this);
    }

    public function getUser()
    {
        return ValueHelpers::getUser($this);
    }

    public function getRatings()
    {
        $ratings = Ratings::findOne(['place_id' => $this->id]);
        return (!empty($ratings)) ? $ratings->average : 0;
    }

    public function getProvinceName()
    {
        return Province::findOne($this->province_id)->name;
    }

    public function getDistrictName()
    {
        return District::findOne($this->district_id)->name;
    }

    public function getSectorName()
    {
        return Sector::findOne($this->sector_id)->name;
    }

    public function getCellName()
    {
        return Cell::findOne($this->cell_id)->name;
    }

    public static function searchPlaces($post)
    {
        return self::find()->filterWhere(['like', 'name', $post['name']]);
    }

    public function getGalleries()
    {
        return Gallery::find()
            ->where(['place_id' => $this->id])
            ->orderBy(new Expression('RAND()'))
            ->limit(1)
            ->all();
    }

    public function getContactNames($type)
    {
        $contacts = Contact::findAll(['place_id' => $this->id, 'type' => $type, 'status' => Yii::$app->params['active']]);

        $contact_name = array();
        foreach ($contacts as $contact) :

            $contact_name[] = $contact->name;

        endforeach;

        return implode('; ', $contact_name);
    }

    public function getProfileTypeName()
    {
        if ($this->profile_type == Yii::$app->params['PREMIUM']):
            $profile_type = Yii::t('app', 'Premium');
        elseif ($this->profile_type == Yii::$app->params['BASIC']):
            $profile_type = Yii::t('app', 'Basic');
        elseif ($this->profile_type == Yii::$app->params['FREE']):
            $profile_type = Yii::t('app', 'Free');
        else:
            $profile_type = Yii::t('app', 'Not Set');
        endif;

        return $profile_type;
    }
}