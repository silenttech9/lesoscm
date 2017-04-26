<?php

namespace frontend\modules\malaysia\models;

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
 * This is the model class for table "quotation".
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
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'customer_ship_id', 'agent_id', 'tax_code_id', 'area_code_id', 'currency_id', 'enter_by', 'update_by', 'revise_id', 'validity_id', 'delivery_id', 'tender_id', 'cc_customer_ship_id', 'state_id'], 'integer'],
            [['remark', 'tender', 'tender_visible', 'status','sales_review'], 'string'],
            [['date_create', 'date_update', 'date_revise'], 'safe'],
            [['discount','amount'], 'number'],
            [['datetime'], 'string', 'max' => 50],
            [['quotation_no'], 'string', 'max' => 255],
            [['revise'], 'string', 'max' => 10],
            [['status_quote','sales_review_datetime'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'DATE TIME',
            'customer_id' => 'CUSTOMER',
            'customer_ship_id' => 'CUSTOMER PIC',
            'agent_id' => 'AGENT',
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

    public static function pending($state_id)
    {
        $connection = \Yii::$app->db;
        $user = Yii::$app->user->identity->id;
        
        if ($user == 12 || $user == 13) {
            $sql = $connection->createCommand("SELECT COUNT(id) FROM quotation WHERE status_quote = 'Pending' and state_id = ".$state_id);
        }
        else{
            $sql = $connection->createCommand("SELECT COUNT(q.id) FROM quotation q LEFT JOIN lookup_agent a on a.id = q.agent_id LEFT JOIN user u on u.id = a.user_id WHERE q.status_quote = 'Pending' and q.state_id = '".$state_id."' and a.user_id =".$user);
        }

        $data = $sql->queryScalar();
        return $data;

    }

    public static function win($state_id)
    {
        $user = Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        if ($user == 12 || $user == 13) {
            $sql = $connection->createCommand("SELECT COUNT(id) FROM quotation WHERE status_quote = 'Win' and state_id = ".$state_id);
            
        }
        else{
            $sql = $connection->createCommand("SELECT COUNT(q.id) FROM quotation q LEFT JOIN lookup_agent a on a.id = q.agent_id LEFT JOIN user u on u.id = a.user_id WHERE q.status_quote = 'Win' and q.state_id = '".$state_id."' and a.user_id =".$user);
        }
        $data = $sql->queryScalar();
        return $data;

    }

    public static function lost($state_id)
    {   
        $user = Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        
        if ($user == 12 || $user == 13) {
            $sql = $connection->createCommand("SELECT COUNT(id) FROM quotation WHERE status_quote = 'Lost' and state_id = ".$state_id);
        }
        else{
            $sql = $connection->createCommand("SELECT COUNT(q.id) FROM quotation q LEFT JOIN lookup_agent a on a.id = q.agent_id LEFT JOIN user u on u.id = a.user_id WHERE q.status_quote = 'Lost' and q.state_id = '".$state_id."' and a.user_id =".$user);
        }
        
        $data = $sql->queryScalar();

        return $data;

    }
    public static function active($state_id)
    {
        $user = Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        if ($user == 12 || $user == 13) {
            $sql = $connection->createCommand("SELECT COUNT(id) FROM quotation WHERE status_quote = 'Active' and state_id = ".$state_id);
        }
        else{
            $sql = $connection->createCommand("SELECT COUNT(q.id) FROM quotation q LEFT JOIN lookup_agent a on a.id = q.agent_id LEFT JOIN user u on u.id = a.user_id WHERE q.status_quote = 'Active' and q.state_id = '".$state_id."' and a.user_id =".$user);
        }
        
        $data = $sql->queryScalar();

        return $data;

    }
    public static function requote($state_id)
    {
        $user = Yii::$app->user->identity->id;
        $connection = \Yii::$app->db;
        if ($user == 12 || $user == 13) {
            $sql = $connection->createCommand("SELECT COUNT(id) FROM quotation WHERE status_quote = 'Requote' and state_id = ".$state_id);
        }
        else{
            $sql = $connection->createCommand("SELECT COUNT(q.id) FROM quotation q LEFT JOIN lookup_agent a on a.id = q.agent_id LEFT JOIN user u on u.id = a.user_id WHERE q.status_quote = 'Requote' and q.state_id = '".$state_id."' and a.user_id =".$user);
        }
        
        $data = $sql->queryScalar();

        return $data;

    }

    public static function hidestatus($state_id)
    {
        $userid = Yii::$app->user->identity->id;

        $agent = LookupAgent::find()
                ->where(['state_id'=>$state_id])
                ->andWhere(['user_id'=>$userid])
                ->one();
        if (isset($agent)) {
            $show = '';
        }
        else{
            $show = 'style=display:none';
        }

        return $show;
    }
}
