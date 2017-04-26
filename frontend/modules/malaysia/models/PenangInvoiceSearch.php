<?php

namespace frontend\modules\malaysia\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\malaysia\models\PenangInvoice;

/**
 * PenangInvoiceSearch represents the model behind the search form about `frontend\modules\malaysia\models\PenangInvoice`.
 */
class PenangInvoiceSearch extends PenangInvoice
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'ref_no', 'item_no', 'description', 'quantity', 'selling_price', 'amount', 'company_name', 'agent', 'status','globalSearch'], 'safe'],
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
        $query = PenangInvoice::find();

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
        ]);

        $query->orFilterWhere(['like', 'ref_no', $this->globalSearch])
            ->orFilterWhere(['like', 'item_no', $this->globalSearch])
            ->orFilterWhere(['like', 'description', $this->globalSearch])
            ->orFilterWhere(['like', 'company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'agent', $this->globalSearch])
            ->orFilterWhere(['like', 'status', $this->globalSearch]);


        return $dataProvider;
    }
}
