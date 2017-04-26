<?php

namespace frontend\modules\thailand\models;

use Yii;
use common\models\LookupAgent;
use common\models\LookupStax;
use common\models\LookupArea;
use common\models\LookupDelivery;
use common\models\LookupValidity;
use common\models\LookupCurrency;
use common\models\LookupTender;
use frontend\models\User;
/**
 * This is the model class for table "quotation_thailand".
 *
 * @property integer $id
 * @property string $datetime
 * @property integer $customer_id
 * @property integer $customer_ship_id
 * @property integer $agent_id
 * @property integer $tax_code_id
 * @property integer $area_code_id
 * @property integer $currency_id
 * @property string $remark
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property string $quotation_no
 * @property string $revise
 * @property integer $revise_id
 * @property string $date_revise
 * @property integer $validity_id
 * @property integer $delivery_id
 * @property string $tender
 * @property integer $tender_id
 * @property string $tender_visible
 * @property integer $cc_customer_ship_id
 * @property integer $state_id
 * @property string $status
 * @property double $discount
 */
class QuotationThailand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation_thailand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_ship_id', 'agent_id', 'tax_code_id', 'area_code_id', 'currency_id', 'enter_by', 'update_by', 'revise_id', 'validity_id', 'delivery_id', 'tender_id', 'cc_customer_ship_id', 'state_id'], 'integer'],
            [['remark', 'tender', 'tender_visible', 'status'], 'string'],
            [['date_create', 'date_update', 'date_revise'], 'safe'],
            [['discount'], 'number'],
            [['datetime'], 'string', 'max' => 50],
            [['quotation_no'], 'string', 'max' => 255],
            [['revise'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'customer_id' => 'Customer',
            'customer_ship_id' => 'Customer PIC',
            'agent_id' => 'Agent',
            'tax_code_id' => 'Tax Code',
            'area_code_id' => 'Area Code',
            'currency_id' => 'Currency',
            'remark' => 'Remark',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'quotation_no' => 'Quotation No',
            'revise' => 'Revise',
            'revise_id' => 'Revise',
            'date_revise' => 'Date Revise',
            'validity_id' => 'Validity',
            'delivery_id' => 'Delivery',
            'tender' => 'Tender',
            'tender_id' => 'Tender',
            'tender_visible' => 'Tender Visible',
            'cc_customer_ship_id' => 'Cc Customer Ship',
            'state_id' => 'State',
            'status' => 'Status',
            'discount' => 'Discount',
            'module_id' => 'Module',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getAttension()
    {
        return $this->hasOne(CustomerPic::className(), ['id' => 'customer_ship_id']);
    }
    public function getCc()
    {
        return $this->hasOne(CustomerPic::className(), ['id' => 'cc_customer_ship_id']);
    }
    public function getAgent()
    {
        return $this->hasOne(LookupAgent::className(), ['id' => 'agent_id']);
    }
    public function getTax()
    {
        return $this->hasOne(LookupStax::className(), ['id' => 'tax_code_id']);
    }
    public function getArea()
    {
        return $this->hasOne(LookupArea::className(), ['id' => 'area_code_id']);
    }

    public function getValidity()
    {
        return $this->hasOne(LookupValidity::className(), ['id' => 'validity_id']);
    }
    public function getDelivery()
    {
        return $this->hasOne(LookupDelivery::className(), ['id' => 'delivery_id']);
    }
    public function getCurrency()
    {
        return $this->hasOne(LookupCurrency::className(), ['id' => 'currency_id']);
    }
    public function getTenders()
    {
        return $this->hasOne(LookupTender::className(), ['id' => 'tender_id']);
    }
    public function getQuoted()
    {
        return $this->hasOne(User::className(), ['id' => 'enter_by']);
    }
    public function getReviseby()
    {
        return $this->hasOne(User::className(), ['id' => 'revise_id']);
    }



    
}
