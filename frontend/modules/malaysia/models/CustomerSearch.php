<?php

namespace frontend\modules\malaysia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\malaysia\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `frontend\modules\malaysia\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'term_id', 'area_code_id', 'agent_id', 'staxcode_id', 'state_id', 'country_id', 'enter_by', 'update_by', 'render_state_id'], 'integer'],
            [['cust_code', 'company_name', 'address', 'country_code_phone', 'area_code_phone', 'telephone_no', 'crlimit', 'postcode', 'city', 'country_code_fax', 'area_code_fax', 'fax_no', 'email', 'date_create', 'date_update','globalSearch'], 'safe'],
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
        $query = Customer::find();

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


        $query->orFilterWhere(['like', 'cust_code', $this->globalSearch])
            ->orFilterWhere(['like', 'company_name', $this->globalSearch]);


        return $dataProvider;
    }
}
