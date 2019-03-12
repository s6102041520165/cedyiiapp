<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bank;

/**
 * BankSearch represents the model behind the search form of `app\models\Bank`.
 */
class BankSearch extends Bank
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bankID', 'bankNum'], 'integer'],
            [['nameAccount', 'bank'], 'safe'],
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
        $query = Bank::find();

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
            'bankID' => $this->bankID,
            'bankNum' => $this->bankNum,
        ]);

        $query->andFilterWhere(['like', 'nameAccount', $this->nameAccount])
            ->andFilterWhere(['like', 'bank', $this->bank]);

        return $dataProvider;
    }
}
