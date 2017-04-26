<?php

namespace frontend\modules\thailand\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\thailand\models\ThailandStock;

/**
 * ThailandStockSearch represents the model behind the search form about `frontend\modules\thailand\models\ThailandStock`.
 */
class ThailandStockSearch extends ThailandStock
{
    /**
     * @inheritdoc
     */
     public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ITEM_NO', 'DESCRIPTION', 'LOCATION', 'BAL', 'UNIT_COST', 'TOTAL_COST','globalSearch'], 'safe'],
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
        $query = ThailandStock::find();

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

        $query->orFilterWhere(['like', 'ITEM_NO', $this->globalSearch])
            ->orFilterWhere(['like', 'DESCRIPTION', $this->globalSearch])
            ->orFilterWhere(['like', 'BAL', $this->globalSearch]);
        // grid filtering conditions

        return $dataProvider;
    }
}
