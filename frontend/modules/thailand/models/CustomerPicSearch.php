<?php

namespace frontend\modules\thailand\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\thailand\models\CustomerPic;

/**
 * CustomerPicSearch represents the model behind the search form about `frontend\modules\thailand\models\CustomerPic`.
 */
class CustomerPicSearch extends CustomerPic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enter_by', 'update_by'], 'integer'],
            [['name', 'department', 'country_code_phone', 'area_code_phone', 'telephone_no', 'extension', 'country_code_mobile', 'area_code_mobile', 'mobile_no', 'email', 'customer_id', 'date_create', 'date_update'], 'safe'],
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
        $query = CustomerPic::find();

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
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'enter_by' => $this->enter_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'country_code_phone', $this->country_code_phone])
            ->andFilterWhere(['like', 'area_code_phone', $this->area_code_phone])
            ->andFilterWhere(['like', 'telephone_no', $this->telephone_no])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'country_code_mobile', $this->country_code_mobile])
            ->andFilterWhere(['like', 'area_code_mobile', $this->area_code_mobile])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id]);

        return $dataProvider;
    }
}
