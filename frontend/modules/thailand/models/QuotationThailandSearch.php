<?php

namespace frontend\modules\thailand\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\thailand\models\QuotationThailand;

/**
 * QuotationThailandSearch represents the model behind the search form about `frontend\modules\thailand\models\QuotationThailand`.
 */
class QuotationThailandSearch extends QuotationThailand
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'customer_id', 'customer_ship_id', 'agent_id', 'tax_code_id', 'area_code_id', 'currency_id', 'enter_by', 'update_by', 'revise_id', 'validity_id', 'delivery_id', 'tender_id', 'cc_customer_ship_id', 'state_id'], 'integer'],
            [['datetime', 'remark', 'date_create', 'date_update', 'quotation_no', 'revise', 'date_revise', 'tender', 'tender_visible', 'status','globalSearch'], 'safe'],
            [['discount'], 'number'],
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
        $query = QuotationThailand::find();

        $query->joinWith(['customer']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->orFilterWhere(['like', 'customer.company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'quotation_no', $this->globalSearch]);

        return $dataProvider;
    }
}
