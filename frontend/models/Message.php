<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id
 * @property string $module
 * @property string $sub_module
 * @property integer $id_module
 * @property string $status
 * @property string $notification
 * @property integer $message_from
 * @property integer $message_to
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_module', 'message_from', 'message_to', 'enter_by', 'update_by'], 'integer'],
            [['status', 'notification'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['module', 'sub_module'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'sub_module' => 'Sub Module',
            'id_module' => 'Id Module',
            'status' => 'Status',
            'notification' => 'Notification',
            'message_from' => 'Message From',
            'message_to' => 'Message To',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }

    public static function message()
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(id) AS totalMessage FROM message WHERE message_to = '".$user_id."' AND status = 'Pending' AND message.notification = 'Unread' "); /*AND DATE_FORMAT(date_create,'%Y-%m-%d') = CURDATE() */
        $data = $sql->queryAll();

        return $data;

    }

    public static function messagelist()
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT message.module,message.sub_module,message.status,message.id_module,`user`.username AS from_who,message.date_create AS date_message,message_log.log_message FROM message 
RIGHT JOIN message_log ON message.id = message_log.message_id
RIGHT JOIN `user` ON message.message_from = `user`.id
WHERE message.message_to = '".$user_id."' AND message.status = 'Pending' AND message.notification = 'Unread' ORDER BY message.date_create DESC");
                $data = $sql->queryAll();
                /*  AND DATE_FORMAT(message.date_create,'%Y-%m-%d') = CURDATE() DATE_FORMAT(message.date_create,'%Y-%m-%d') AS date_message */
        return $data;

    }

    
}
