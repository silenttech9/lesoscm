<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "joborder_log".
 *
 * @property integer $id
 * @property string $status
 * @property integer $job_order_id
 * @property string $datetime
 * @property integer $enter_by
 */
class JoborderLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'joborder_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_order_id', 'enter_by'], 'integer'],
            [['date_joborder'], 'string','max'=>200],
            [['status'], 'string', 'max' => 300],
            [['job_order_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'job_order_id' => 'Job Order ID',
            'datetime' => 'Datetime',
            'enter_by' => 'Enter By',
            
        ];
    }

    public function getHistoryenterby()
    {
        return $this->hasOne(User::className(),['id'=>'enter_by']);
    }
}
