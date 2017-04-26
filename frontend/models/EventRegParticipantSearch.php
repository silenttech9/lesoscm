<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EventRegParticipant;

/**
 * EventRegParticipantSearch represents the model behind the search form about `frontend\models\EventRegParticipant`.
 */
class EventRegParticipantSearch extends EventRegParticipant
{
    /**
     * @inheritdoc
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'event_id', 'eventreg_id'], 'integer'],
            [['name_participant', 'email', 'designation', 'mobile_phone', 'created_at', 'status','globalSearch','reminder'], 'safe'],
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
        $query = EventRegParticipant::find();

        $query->joinWith(['eventname']);
        $query->joinWith(['regname']);
        // $query->joinWith(['eventname']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => [
            //     'pagesize' => 80,
            // ],
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
            'event_id' => $this->event_id,
            'eventreg_id' => $this->eventreg_id,
        ]);

        $query->orFilterWhere(['like', 'name_participant', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'designation', $this->globalSearch])
            ->orFilterWhere(['like', 'mobile_phone', $this->globalSearch])
            ->orFilterWhere(['like', 'event_reg.company_name', $this->globalSearch])
            ->orFilterWhere(['like', 'status', $this->globalSearch])
            ->orFilterWhere(['like', 'event_manager.title', $this->globalSearch]);

        return $dataProvider;
    }
}
