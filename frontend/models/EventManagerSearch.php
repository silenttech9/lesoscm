<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EventManager;

/**
 * EventManagerSearch represents the model behind the search form about `frontend\models\EventManager`.
 */
class EventManagerSearch extends EventManager
{
    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'max_participant_perevent', 'max_participant_percompany', 'enter_by'], 'integer'],
            [['title', 'date_event', 'time_event_start', 'time_event_end', 'venue_event', 'objective_event', 'fee_event', 'incentive_company', 'incentive_attendee', 'reg_due_date', 'img_brochure', 'created_at','globalSearch'], 'safe'],
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
        $query = EventManager::find();

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

        $query->orFilterWhere(['like', 'title', $this->globalSearch])
            ->orFilterWhere(['like', 'date_event', $this->globalSearch])
            ->orFilterWhere(['like', 'time_event_start', $this->globalSearch])
            ->orFilterWhere(['like', 'time_event_end', $this->globalSearch])
            ->orFilterWhere(['like', 'venue_event', $this->globalSearch])
            ->orFilterWhere(['like', 'objective_event', $this->globalSearch])
            ->orFilterWhere(['like', 'fee_event', $this->globalSearch])
            ->orFilterWhere(['like', 'incentive_company', $this->globalSearch])
            ->orFilterWhere(['like', 'incentive_attendee', $this->globalSearch])
            ->orFilterWhere(['like', 'reg_due_date', $this->globalSearch])
            ->orFilterWhere(['like', 'img_brochure', $this->globalSearch])
            ->orFilterWhere(['like', 'created_at', $this->globalSearch]);

        return $dataProvider;
    }
}
