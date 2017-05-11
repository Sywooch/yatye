<?php

namespace backend\models\place;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SearchPlace represents the model behind the search form about `backend\models\Place`.
 */
class SearchPlace extends Place
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'district_id', 'sector_id', 'cell_id', 'village_id', 'profile_type', 'views', 'status', 'created_by', 'category', 'main'], 'integer'],
            [['name', 'description', 'slug', 'code', 'logo', 'neighborhood', 'street', 'created_at', 'expire_at', 'updated_at'], 'safe'],
            [['latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Place::find()->where(['!=', 'status', Yii::$app->params['rejected']]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'sector_id' => $this->sector_id,
            'cell_id' => $this->cell_id,
            'village_id' => $this->village_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'profile_type' => $this->profile_type,
            'created_at' => $this->created_at,
            'expire_at' => $this->expire_at,
            'updated_at' => $this->updated_at,
            'views' => $this->views,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'category' => $this->category,
            'main' => $this->main,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'neighborhood', $this->neighborhood])
            ->andFilterWhere(['like', 'street', $this->street])
            ->orderBy('name');

        return $dataProvider;
    }
}
