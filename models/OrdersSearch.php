<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;
use app\models\User;
use Yii;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderID'], 'integer','message'=>'กรุณาป้อนตัวเลข'],
            [['dateBooking'], 'safe','message'=>'กรุณาข้อมูลวันที่'],
	    [['userID'],'integer','message'=>'กรุณาป้อนรหัสสมาชิก'],
            [['price'], 'number','message'=>'กรุณาป้อนตัวเลข'],
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
        //$query = Orders::find()->where(['userID'=>Yii::$app->user->identity->userID]);
        if(Yii::$app->user->identity->role == 1){
            $condition = ['user.userID'=>Yii::$app->user->identity->userID];
        }
        $query = Orders::find()
        ->joinWith(['user'])
        ->where($condition);
        //$query = User::find()->where(['userID'=>Yii::$app->user->identity->userID]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
	    'pagination' => [ 'pageSize' => 10 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like','user.email' , $this->userID])

	->andFilterWhere([
            'and',
            ['orderID' => $this->orderID],
            ['like','dateBooking' , $this->dateBooking],
            ['price' => $this->price],
        ]);

        return $dataProvider;
    }
}
