<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_survey_answer".
 *
 * @property integer $id
 * @property integer $id_question
 * @property string $answer
 * @property integer $id_attendee
 * @property string $created_at
 * @property integer $event_id
 */
class EventSurveyAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_survey_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_question', 'id_attendee', 'event_id'], 'integer'],
            [['answer'], 'string'],
            [['created_at'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_question' => 'Id Question',
            'answer' => 'Answer',
            'id_attendee' => 'Id Attendee',
            'created_at' => 'Created At',
            'event_id' => 'Event ID',
        ];
    }

    public function getSurveyname()
    {
        return $this->hasOne(EventRegParticipant::className(),['id'=>'id_attendee']);
    }

    public function getQuestion()
    {
        return $this->hasOne(EventSurveyQuestion::className(),['id' =>'id_question']);
    }

    public static function calculate($value,$eventid)
    {
        $model = EventSurveyAnswer::find()
                ->where(['id_attendee'=>$value])
                ->andWhere(['event_id'=>$eventid])
                ->all();

        $fullmark = 0;
        foreach ($model as $mark) {
            $fullmark = $fullmark + $mark['mark'];
        }

        $percentage = ($fullmark / 25) * 100;
        return $percentage.'%';

    }
}
