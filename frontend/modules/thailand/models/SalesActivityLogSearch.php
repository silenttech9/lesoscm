<?php

namespace frontend\modules\thailand\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\thailand\models\SalesActivityLog;

/**
 * SalesActivityLogSearch represents the model behind the search form about `frontend\modules\thailand\models\SalesActivityLog`.
 */
class SalesActivityLogSearch extends SalesActivityLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_pic_id', 'sales_specialist_id', 'sales_agent', 'enter_by', 'update_by', 'id_sales_activity'], 'integer'],
            [['activity', 'reminder', 'reminder_time', 'reminder_remark', 'sales_visit', 'sales_visit_date', 'sales_visit_information', 'quotation', 'remark', 'date_create', 'date_update'], 'safe'],
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
        $query = SalesActivityLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => 'DESC']]
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
            'customer_pic_id' => $this->customer_pic_id,
            'sales_specialist_id' => $this->sales_specialist_id,
            'sales_agent' => $this->sales_agent,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
            'enter_by' => $this->enter_by,
            'update_by' => $this->update_by,
            'id_sales_activity' => $this->id_sales_activity,
        ]);

        $query->andFilterWhere(['like', 'activity', $this->activity])
            ->andFilterWhere(['like', 'reminder', $this->reminder])
            ->andFilterWhere(['like', 'reminder_time', $this->reminder_time])
            ->andFilterWhere(['like', 'reminder_remark', $this->reminder_remark])
            ->andFilterWhere(['like', 'sales_visit', $this->sales_visit])
            ->andFilterWhere(['like', 'sales_visit_date', $this->sales_visit_date])
            ->andFilterWhere(['like', 'sales_visit_information', $this->sales_visit_information])
            ->andFilterWhere(['like', 'quotation', $this->quotation])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
