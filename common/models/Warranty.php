<?php

namespace common\models;

use Yii;
use common\models\LookupDeliveryMode;
use frontend\modules\malaysia\models\CustomerPic;
/**
 * This is the model class for table "warranty".
 *
 * @property integer $id
 * @property string $serial_number
 * @property string $warranty_period
 * @property integer $delivery_mode_id
 * @property string $delivery_date
 * @property string $consignment_number
 * @property string $update_customer
 * @property string $machine_end_of_life
 * @property string $service_required
 * @property string $reminder
 * @property integer $day_for_services
 * @property string $status_services
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $invoice_id
 * @property integer $customer_id
 * @property integer $customer_pic_id
 */
class Warranty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warranty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warranty_period', 'update_customer', 'machine_end_of_life', 'service_required', 'reminder', 'status_services'], 'string'],
            [['delivery_mode_id', 'day_for_services', 'enter_by', 'update_by', 'invoice_id', 'customer_id', 'customer_pic_id','state_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['serial_number'], 'string', 'max' => 255],
            [['delivery_date', 'consignment_number'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serial_number' => 'Serial Number',
            'warranty_period' => 'Warranty Period',
            'delivery_mode_id' => 'Delivery Mode',
            'delivery_date' => 'Delivery Date',
            'consignment_number' => 'Consignment Number',
            'update_customer' => 'Update Customer',
            'machine_end_of_life' => 'Machine End Of Life',
            'service_required' => 'Service Required',
            'reminder' => 'Reminder',
            'day_for_services' => 'Day For Services',
            'status_services' => 'Status Services',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'invoice_id' => 'Invoice',
            'customer_id' => 'Customer',
            'customer_pic_id' => 'Customer PIC',
            'state_id' => 'State',
        ];
    }

    public function getDelimode()
    {
        return $this->hasOne(LookupDeliveryMode::className(), ['id' => 'delivery_mode_id']);
    }

    public function getCustpic()
    {
        return $this->hasOne(CustomerPic::className(), ['id' => 'customer_pic_id']);
    }


}
