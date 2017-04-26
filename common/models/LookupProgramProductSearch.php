<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LookupProgramProduct;

/**
 * LookupProgramProductSearch represents the model behind the search form about `common\models\LookupProgramProduct`.
 */
class LookupProgramProductSearch extends LookupProgramProduct
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'state_id', 'enter_by', 'update_by', 'module_id'], 'integer'],
            [['program_product', 'date_create', 'date_update','globalSearch'], 'safe'],
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
        $query = LookupProgramProduct::find();

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

        $query->orFilterWhere(['like', 'program_product', $this->globalSearch]);
        // grid filtering conditions


        return $dataProvider;
    }
}
