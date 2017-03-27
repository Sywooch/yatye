<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/19/17
 * Time: 7:14 PM
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use backend\models\PlaceService;
use backend\models\Service;
use common\models\Filter as BaseFilter;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Filter extends BaseFilter
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
        ];
    }

    public function rules()
    {
        return [
            [['province_id', 'district_id', 'category_id', 'service_id', 'results', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['results', 'user_id'], 'required'],
            [['key_word', 'ip_address'], 'string', 'max' => 255],
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
    public function filter($params)
    {
        $this->load($params);

        $sub_query_one = $this->filterByCategory();
        $sub_query_two = $this->filterByService();

        $query = Place::find()
            ->where(['status' => Yii::$app->params['active']])
            ->andFilterWhere(
                [
                    'province_id' => $this->province_id,
                    'district_id' => $this->district_id,
                ]
            )
            ->andFilterWhere(['in', 'id', $sub_query_one])
            ->andFilterWhere(['in', 'id', $sub_query_two])
            ->orderBy(new Expression('`profile_type` <> ' . Yii::$app->params['PREMIUM']));

        $query->andFilterWhere(['like', 'name', $this->key_word]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort' => [
                'defaultOrder' => [
                    'profile_type' => SORT_ASC,
                ]
            ],
        ]);

        if ($this->key_word != null || $this->province_id != null || $this->category_id != null) {
            $results = $query->count();
            $this->ip_address = Yii::$app->request->getUserIP();
            $this->results = $results;
            //$this->user_id = Yii::$app->user->identity->id;
            $this->save(0);
        }

        return $dataProvider;
    }

    public function filterByService()
    {
        $place_services = PlaceService::find()
            ->distinct()
            ->filterWhere(['service_id' => $this->service_id])
            ->all();
        $place_ids = array();
        foreach ($place_services as $place_service) {
            $place_ids[] = $place_service->place_id;
        }
        return $place_ids;
    }

    public function filterByCategory()
    {
        $services = Service::find()->where(['category_id' => $this->category_id])->all();

        $service_ids = array();
        foreach ($services as $service) {
            $service_ids[] = $service->id;
        }

        $place_services = PlaceService::find()
            ->distinct()
            ->filterWhere(['in', 'service_id', $service_ids])
            ->all();

        $place_ids = array();
        foreach ($place_services as $place_service) {
            $place_ids[] = $place_service->place_id;
        }

        return $place_ids;
    }
}