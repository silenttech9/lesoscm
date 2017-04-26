<?php

namespace frontend\modules\thailand\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\thailand\models\Telemarketing;

/**
 * TelemarketingSearch represents the model behind the search form about `frontend\modules\thailand\models\Telemarketing`.
 */
class TelemarketingSearch extends Telemarketing
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'program_product_id', 'telemarketers_id', 'state_id', 'enter_by', 'update_by', 'module_id'], 'integer'],
            [['datetime', 'date_create', 'date_update','globalSearch'], 'safe'],
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
        $query = Telemarketing::find();

        $query->joinWith(['product','telemarket']);
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


        $query->orFilterWhere(['like', 'lookup_program_product.program_product', $this->globalSearch])
            ->orFilterWhere(['like', 'user.username', $this->globalSearch]);

        return $dataProvider;
    }
}
