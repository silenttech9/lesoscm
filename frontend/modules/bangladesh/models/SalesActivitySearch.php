<?php

namespace frontend\modules\bangladesh\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\bangladesh\models\SalesActivity;

/**
 * SalesActivitySearch represents the model behind the search form about `frontend\modules\thailand\models\SalesActivity`.
 */
class SalesActivitySearch extends SalesActivity
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'customer_id', 'customer_pic_id', 'state_id', 'enter_by', 'update_by', 'module_id'], 'integer'],
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
        $query = SalesActivity::find();
        $query->joinWith(['customer','enterby']);
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


        $query->orFilterWhere(['like', 'customer.company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'user.username', $this->globalSearch]);

        return $dataProvider;
    }
}
