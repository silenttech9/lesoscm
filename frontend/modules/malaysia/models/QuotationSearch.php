<?php

namespace frontend\modules\malaysia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\malaysia\models\Quotation;

/**
 * QuotationSearch represents the model behind the search form about `frontend\modules\malaysia\models\Quotation`.
 */
class QuotationSearch extends Quotation
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public $company_name;
    public $agent;
    public $mindate;
    public $maxdate;
    public $minamount;
    public $maxamount;

    public function rules()
    {
        return [
            [['id', 'customer_id', 'customer_ship_id', 'agent_id', 'tax_code_id', 'area_code_id', 'currency_id', 'enter_by', 'update_by', 'revise_id', 'validity_id', 'delivery_id', 'tender_id', 'cc_customer_ship_id', 'state_id'], 'integer'],
            [['datetime', 'remark', 'date_create', 'date_update', 'quotation_no', 'revise', 'date_revise', 'tender', 'tender_visible', 'status','globalSearch','status_quote','sales_review','sales_review_datetime','company_name','agent','mindate','maxdate','minamount','maxamount'], 'safe'],
            [['discount','amount'], 'number'],
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
        $query = Quotation::find();

        $query->joinWith(['customer']);
        $query->joinWith(['quoted']);
        $query->joinWith(['agent']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['datetime' => 'DESC']]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // if (!empty($this->mindate)) {
        //     // echo '<script>console.log('.$this->mindate.')</script>';
            
        // }
        $query->andFilterWhere(['between', 'datetime', $this->mindate, $this->maxdate]);
            $query->andFilterWhere(['quotation.agent_id'=>$this->agent_id]);
            $query->andFilterWhere(['between', 'amount', $this->minamount, $this->maxamount]);
            $query->andFilterWhere(['like', 'customer.company_name', $this->company_name]);
            $query->andFilterWhere(['like','status_quote', $this->status_quote]);
        // $query->andFilterWhere([
        //     'quotation_no' => $this->quotation_no,
        //     'amount'=>$this->amount,
        //     'customer.company_name'=>$this->company_name,
        //     'lookup_agent.agent'=>$this->agent,
        //     // 'datetime'=>$thi
        // ]);

        $query->orFilterWhere(['like', 'customer.company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'quotation_no', $this->globalSearch])
            ->orFilterWhere(['like', 'lookup_agent.agent', $this->globalSearch])
            ->orFilterWhere(['like', 'user.username', $this->globalSearch]);


        return $dataProvider;
    }
}
