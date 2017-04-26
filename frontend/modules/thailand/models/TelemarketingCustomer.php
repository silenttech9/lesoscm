<?php

namespace frontend\modules\thailand\models;

use Yii;

/**
 * This is the model class for table "telemarketing_customer".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $customer_pic_id
 * @property string $activity
 * @property string $sales_visit
 * @property integer $sales_specialist_id
 * @property string $sales_visit_date
 * @property string $sales_visit_information
 * @property integer $sales_agent
 * @property string $remark
 * @property string $reminder
 * @property string $datetime
 * @property string $remark_reminder
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $id_telemarketing
 * @property string $quotation
 */
class TelemarketingCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telemarketing_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_pic_id', 'sales_specialist_id', 'sales_agent', 'enter_by', 'update_by', 'id_telemarketing'], 'integer'],
            [['activity', 'sales_visit', 'sales_visit_information', 'remark', 'reminder', 'remark_reminder', 'quotation'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['sales_visit_date', 'datetime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer',
            'customer_pic_id' => 'Customer PIC',
            'activity' => 'Activity',
            'sales_visit' => 'Sales Visit',
            'sales_specialist_id' => 'Sales Specialist',
            'sales_visit_date' => 'Sales Visit Date',
            'sales_visit_information' => 'Sales Visit Information',
            'sales_agent' => 'Sales Agent',
            'remark' => 'Remark',
            'reminder' => 'Reminder',
            'datetime' => 'Datetime',
            'remark_reminder' => 'Remark Reminder',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'id_telemarketing' => 'Id Telemarketing',
            'quotation' => 'Quotation',
        ];
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    public function getPic()
    {
        return $this->hasOne(CustomerPic::className(), ['id' => 'customer_pic_id']);
    }

}
