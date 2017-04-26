<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "message_log".
 *
 * @property integer $id
 * @property string $log_message
 * @property integer $message_id
 */
class MessageLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_message'], 'string'],
            [['message_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_message' => 'Log Message',
            'message_id' => 'Message ID',
        ];
    }
}
