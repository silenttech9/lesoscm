<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EventSurveyAnswer;

/**
 * EventSurveyAnswerSearch represents the model behind the search form about `frontend\models\EventSurveyAnswer`.
 */
class EventSurveyAnswerSearch extends EventSurveyAnswer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_question', 'id_attendee', 'event_id'], 'integer'],
            [['answer', 'created_at'], 'safe'],
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
        $query = EventSurveyAnswer::find();

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
            'id_question' => $this->id_question,
            'id_attendee' => $this->id_attendee,
            'event_id' => $this->event_id,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
