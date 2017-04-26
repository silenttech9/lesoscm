<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reminder_log".
 *
 * @property integer $id
 * @property string $log_reminder
 * @property integer $id_module
 * @property integer $reminder_id
 */
class ReminderLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reminder_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_reminder'], 'string'],
            [['id_module', 'reminder_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_reminder' => 'Log Reminder',
            'id_module' => 'Id Module',
            'reminder_id' => 'Reminder ID',
        ];
    }
}
