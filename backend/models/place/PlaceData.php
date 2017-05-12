<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/22/17
 * Time: 10:08 PM
 */

namespace backend\models\place;

use Yii;
use yii\db\Expression;
use common\models\Cell;
use common\models\Sector;
use frontend\models\Views;
use common\models\District;
use common\models\Province;
use frontend\models\Ratings;
use common\helpers\ValueHelpers;
use common\models\Place as BasePlace;

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

    public function getPlaceUrl()
    {
        return Yii::$app->request->baseUrl . '/place-details/' . $this->slug;
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
        return self::find()->filterWhere(['like', 'name', $post['name']])
            ->andWhere(['!=', 'status', Yii::$app->params['rejected']])
            ->orderBy(new Expression('updated_at'));
    }

    public function getGalleries()
    {
        return Gallery::find()
            ->where(['place_id' => $this->id])
            ->orderBy(new Expression('RAND()'))
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