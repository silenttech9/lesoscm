<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notify_joborder".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property string $date_receive
 * @property integer $job_order_id
 * @property string $read_notify
 * @property string $joborder_desc
 */
class NotifyJoborder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notify_joborder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'job_order_id'], 'integer'],
            [['date_receive'], 'safe'],
            [['joborder_desc'], 'string'],
            [['text'], 'string', 'max' => 300],
            [['read_notify'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'date_receive' => 'Date Receive',
            'job_order_id' => 'Job Order ID',
            'read_notify' => 'Read Notify',
            'joborder_desc' => 'Job Order Description',
        ];
    }

    public function getUsername()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
