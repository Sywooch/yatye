<?php

namespace backend\models\post;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\post\Post;
use yii\db\Expression;

/**
 * SearchPost represents the model behind the search form about `backend\models\post\Post`.
 */
class SearchPost extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_category_id', 'post_type_id', 'views', 'status', 'created_by', 'updated_by'], 'integer'],
            [['title', 'introduction', 'slug', 'image', 'caption', 'content', 'ip_address', 'created_at', 'updated_at'], 'safe'],
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
        $query = Post::find()->orderBy(new Expression('created_at DESC'));;

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
            'post_category_id' => $this->post_category_id,
            'post_type_id' => $this->post_type_id,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }
}
