<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $slug
 * @property string $code
 * @property string $logo
 * @property integer $province_id
 * @property integer $district_id
 * @property integer $sector_id
 * @property integer $cell_id
 * @property integer $village_id
 * @property string $neighborhood
 * @property string $street
 * @property double $latitude
 * @property double $longitude
 * @property integer $profile_type
 * @property string $created_at
 * @property string $expire_at
 * @property string $updated_at
 * @property integer $views
 * @property integer $status
 * @property integer $created_by
 * @property integer $category
 * @property integer $main
 *
 * @property Contact[] $contacts
 * @property Enquiry[] $enquiries
 * @property Gallery[] $galleries
 * @property PlaceService[] $placeServices
 * @property Service[] $services
 * @property Product $product
 * @property Ratings[] $ratings
 * @property Review[] $reviews
 * @property SocialMedia[] $socialMedia
 * @property UserPlace[] $userPlaces
 * @property User[] $users
 * @property UserProfile[] $userProfiles
 * @property Views $views0
 * @property WorkingHours[] $workingHours
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'created_at'], 'required'],
            [['description'], 'string'],
            [['province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'profile_type', 'views', 'status', 'created_by', 'category', 'main'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created_at', 'expire_at', 'updated_at'], 'safe'],
            [['name', 'slug', 'logo', 'neighborhood', 'street'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
            'code' => Yii::t('app', 'Code'),
            'logo' => Yii::t('app', 'Logo'),
            'province_id' => Yii::t('app', 'Province ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'sector_id' => Yii::t('app', 'Sector ID'),
            'cell_id' => Yii::t('app', 'Cell ID'),
            'village_id' => Yii::t('app', 'Village ID'),
            'neighborhood' => Yii::t('app', 'Neighborhood'),
            'street' => Yii::t('app', 'Street'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'profile_type' => Yii::t('app', 'Profile Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'views' => Yii::t('app', 'Views'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'category' => Yii::t('app', 'Category'),
            'main' => Yii::t('app', 'Main'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceServices()
    {
        return $this->hasMany(PlaceService::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])->viaTable('place_service', ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialMedia()
    {
        return $this->hasMany(SocialMedia::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_place', ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViews0()
    {
        return $this->hasOne(Views::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingHours()
    {
        return $this->hasMany(WorkingHours::className(), ['place_id' => 'id']);
    }
}
