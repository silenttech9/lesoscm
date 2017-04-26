<?php

namespace frontend\modules\malaysia\models;

use Yii;
use frontend\modules\malaysia\models\CustomerPic;
use frontend\models\User;
/**
 * This is the model class for table "sales_activity_log".
 *
 * @property integer $id
 * @property integer $customer_pic_id
 * @property string $activity
 * @property string $reminder
 * @property string $reminder_time
 * @property string $reminder_remark
 * @property string $sales_visit
 * @property integer $sales_specialist_id
 * @property string $sales_visit_date
 * @property string $sales_visit_information
 * @property string $quotation
 * @property integer $sales_agent
 * @property string $remark
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $id_sales_activity
 */
class SalesActivityLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_activity_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_pic_id', 'sales_specialist_id', 'sales_agent', 'enter_by', 'update_by', 'id_sales_activity'], 'integer'],
            [['activity', 'reminder', 'reminder_remark', 'sales_visit', 'sales_visit_information', 'quotation', 'remark'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['reminder_time', 'sales_visit_date'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_pic_id' => 'Customer PIC',
            'activity' => 'Activity',
            'reminder' => 'Reminder',
            'reminder_time' => 'Reminder Date',
            'reminder_remark' => 'Reminder Remark',
            'sales_visit' => 'Sales Visit',
            'sales_specialist_id' => 'Sales Specialist',
            'sales_visit_date' => 'Sales Visit Date',
            'sales_visit_information' => 'Sales Visit Information',
            'quotation' => 'Quotation',
            'sales_agent' => 'Sales Agent',
            'remark' => 'Remark',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'id_sales_activity' => 'Id Sales Activity',
        ];
    }

    public function getEnter()
    {
        return $this->hasOne(User::className(), ['id' => 'enter_by']);
    }
    public function getUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'update_by']);
    }
    public function getSpecialist()
    {
        return $this->hasOne(User::className(), ['id' => 'sales_specialist_id']);
    }

    public function getSales()
    {
        return $this->hasOne(User::className(), ['id' => 'sales_agent']);
    }

    public function getPic()
    {
        return $this->hasOne(CustomerPic::className(), ['id' => 'customer_pic_id']);
    }



}
