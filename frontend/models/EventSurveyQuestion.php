<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_survey_question".
 *
 * @property integer $id
 * @property string $question
 * @property integer $id_event
 * @property string $created_at
 */
class EventSurveyQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_survey_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_event'], 'integer'],
            [['question'], 'string', 'max' => 300],
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
            'question' => 'Question',
            'id_event' => 'Id Event',
            'created_at' => 'Created At',
        ];
    }
}
