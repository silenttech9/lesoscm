<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Warranty;

/**
 * WarrantySearch represents the model behind the search form about `common\models\Warranty`.
 */
class WarrantySearch extends Warranty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'delivery_mode_id', 'day_for_services', 'enter_by', 'update_by', 'invoice_id', 'customer_id', 'customer_pic_id','state_id'], 'integer'],
            [['serial_number', 'warranty_period', 'delivery_date', 'consignment_number', 'update_customer', 'machine_end_of_life', 'service_required', 'reminder', 'status_services', 'date_create', 'date_update'], 'safe'],
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
        $query = Warranty::find();

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
            'delivery_mode_id' => $this->delivery_mode_id,
            'day_for_services' => $this->day_for_services,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'enter_by' => $this->enter_by,
            'update_by' => $this->update_by,
            'invoice_id' => $this->invoice_id,
            'customer_id' => $this->customer_id,
            'customer_pic_id' => $this->customer_pic_id,
            
        ]);

        $query->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'warranty_period', $this->warranty_period])
            ->andFilterWhere(['like', 'delivery_date', $this->delivery_date])
            ->andFilterWhere(['like', 'consignment_number', $this->consignment_number])
            ->andFilterWhere(['like', 'update_customer', $this->update_customer])
            ->andFilterWhere(['like', 'machine_end_of_life', $this->machine_end_of_life])
            ->andFilterWhere(['like', 'service_required', $this->service_required])
            ->andFilterWhere(['like', 'reminder', $this->reminder])
            ->andFilterWhere(['like', 'status_services', $this->status_services]);

        return $dataProvider;
    }
}
