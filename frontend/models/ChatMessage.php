<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "chat_message".
 *
 * @property string $id
 * @property integer $message_from
 * @property integer $message_to
 * @property string $message
 * @property string $status
 * @property string $created_at
 */
class ChatMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_from', 'message_to'], 'integer'],
            [['message', 'status'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_from' => 'Message From',
            'message_to' => 'Message To',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public static function chatlist()
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(chat_message.id) AS total_chat_message,`user`.username,chat_message.message_from
            FROM chat_message 
            RIGHT JOIN `user` ON `user`.id = chat_message.message_from
            WHERE chat_message.message_to = '".$user_id."' AND chat_message.status = 'Unread' GROUP BY chat_message.message_from,chat_message.id ORDER BY chat_message.id ASC");
        $data = $sql->queryAll();

        return $data;

    }
    
    public static function chatTotal()
    {
        $user_id =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(chat_message.id) AS total_chat_message
            FROM chat_message 
            RIGHT JOIN `user` ON `user`.id = chat_message.message_from
            WHERE chat_message.message_to = '".$user_id."' AND chat_message.status = 'Unread'");
        $data = $sql->queryScalar();

        return $data;

    }

    
}
