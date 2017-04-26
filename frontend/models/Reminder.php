<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reminder".
 *
 * @property integer $id
 * @property string $datetime_reminder
 * @property string $module
 * @property string $status
 * @property integer $reminder_to
 * @property string $notification
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class Reminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'notification'], 'string'],
            [['reminder_to', 'enter_by', 'update_by'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['datetime_reminder', 'module'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime_reminder' => 'Datetime Reminder',
            'module' => 'Module',
            'status' => 'Status',
            'reminder_to' => 'Reminder To',
            'notification' => 'Notification',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }

    public static function reminder()
    {
            
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(id) AS totalReminder FROM reminder WHERE reminder_to = '".$user_id."' AND status = 'Pending'  AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') <= CURDATE()");
        $data = $sql->queryAll();

        return $data;

    }


    public static function reminderlist()
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT reminder_log.log_reminder,reminder.id,DATE_FORMAT(reminder.datetime_reminder,'%Y-%m-%d') AS date_remind,reminder.module,reminder_log.id_module,reminder.status
        FROM reminder_log 
        RIGHT JOIN reminder ON reminder_log.reminder_id = reminder.id 
        WHERE reminder.reminder_to = '".$user_id."' AND reminder.status = 'Pending' AND reminder.notification = 'unread' AND DATE_FORMAT(datetime_reminder,'%Y-%m-%d') <= CURDATE() ORDER BY reminder.datetime_reminder DESC");
                $data = $sql->queryAll();

        return $data;

    }

    
}
