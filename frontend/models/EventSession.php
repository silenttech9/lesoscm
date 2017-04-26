<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_session".
 *
 * @property integer $id
 * @property string $time
 * @property string $activity
 * @property string $created_at
 * @property integer $enter_by
 * @property integer $event_id
 * @property string $updated_at
 */
class EventSession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enter_by', 'event_id'], 'integer'],
            [['time', 'created_at', 'updated_at'], 'string', 'max' => 100],
            [['activity'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'activity' => 'Activity',
            'created_at' => 'Created At',
            'enter_by' => 'Enter By',
            'event_id' => 'Event ID',
            'updated_at' => 'Updated At',
        ];
    }
}
