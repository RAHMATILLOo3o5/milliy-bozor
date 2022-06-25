<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dayticket;

/**
 * DayticketQuery represents the model behind the search form of `backend\models\Dayticket`.
 */
class DayticketQuery extends Dayticket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sale', 'price', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'option_uz', 'option_ru', 'limit_uz', 'limit_ru'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Dayticket::find();

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
            'sale' => $this->sale,
            'price' => $this->price,
            'order' => $this->order,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'option_uz', $this->option_uz])
            ->andFilterWhere(['like', 'option_ru', $this->option_ru])
            ->andFilterWhere(['like', 'limit_uz', $this->limit_uz])
            ->andFilterWhere(['like', 'limit_ru', $this->limit_ru]);

        return $dataProvider;
    }
}
