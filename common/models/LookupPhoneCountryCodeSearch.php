<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LookupPhoneCountryCode;

/**
 * LookupPhoneCountryCodeSearch represents the model behind the search form about `common\models\LookupPhoneCountryCode`.
 */
class LookupPhoneCountryCodeSearch extends LookupPhoneCountryCode
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['country', 'code', 'active','globalSearch'], 'safe'],
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
        $query = LookupPhoneCountryCode::find();

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

        $query->orFilterWhere(['like', 'country', $this->globalSearch])
            ->orFilterWhere(['like', 'active', $this->globalSearch]);

        return $dataProvider;
    }
}
