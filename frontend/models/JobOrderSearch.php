<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\JobOrder;

/**
 * JobOrderSearch represents the model behind the search form about `frontend\models\JobOrder`.
 */
class JobOrderSearch extends JobOrder
{
    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id','customer_id'], 'integer'],
            [['customer_name', 'job_order_no', 'date_joborder', 'tel_no', 'salesman', 'brand', 'model', 'description', 'serial_no', 'received_by', 'receiver_name', 'problem', 'tech_finding', 'tech_action_taken', 'tech_spare_part', 'done_by', 'date_done_by', 'checked_by', 'date_checked_by', 'send_out_by', 'date_send_out_by', 'remark', 'status','globalSearch'], 'safe'],
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
        $query = JobOrder::find();

        $query->joinWith(['custname']);
        $query->joinWith(['indoorname']);
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
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $query->orFilterWhere(['like', 'job_order_no', $this->globalSearch])
            ->orFilterWhere(['like', 'customer.company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'date_joborder', $this->globalSearch])
            ->orFilterWhere(['like', 'lookup_indoor.indoor', $this->globalSearch]);
        // $query->andFilterWhere(['like', 'customer_id', $this->customer_id])
        //     ->andFilterWhere(['like', 'customer_name', $this->customer_name])
        //     ->andFilterWhere(['like', 'job_order_no', $this->job_order_no])
        //     ->andFilterWhere(['like', 'date_joborder', $this->date_joborder])
        //     ->andFilterWhere(['like', 'tel_no', $this->tel_no])
        //     ->andFilterWhere(['like', 'salesman', $this->salesman])
        //     ->andFilterWhere(['like', 'brand', $this->brand])
        //     ->andFilterWhere(['like', 'model', $this->model])
        //     ->andFilterWhere(['like', 'description', $this->description])
        //     ->andFilterWhere(['like', 'serial_no', $this->serial_no])
        //     ->andFilterWhere(['like', 'received_by', $this->received_by])
        //     ->andFilterWhere(['like', 'receiver_name', $this->receiver_name])
        //     ->andFilterWhere(['like', 'problem', $this->problem])
        //     ->andFilterWhere(['like', 'tech_finding', $this->tech_finding])
        //     ->andFilterWhere(['like', 'tech_action_taken', $this->tech_action_taken])
        //     ->andFilterWhere(['like', 'tech_spare_part', $this->tech_spare_part])
        //     ->andFilterWhere(['like', 'done_by', $this->done_by])
        //     ->andFilterWhere(['like', 'date_done_by', $this->date_done_by])
        //     ->andFilterWhere(['like', 'checked_by', $this->checked_by])
        //     ->andFilterWhere(['like', 'date_checked_by', $this->date_checked_by])
        //     ->andFilterWhere(['like', 'send_out_by', $this->send_out_by])
        //     ->andFilterWhere(['like', 'date_send_out_by', $this->date_send_out_by])
        //     ->andFilterWhere(['like', 'remark', $this->remark])
        //     ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
