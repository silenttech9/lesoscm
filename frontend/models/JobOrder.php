<?php

namespace frontend\models;

use Yii;
use common\models\LookupState;
use common\models\Salesman;
use frontend\modules\malaysia\models\CustomerPic;
// use frontend\modules\malaysia\models\Customer;
/**
 * This is the model class for table "job_order".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $customer_name
 * @property string $job_order_no
 * @property string $date_joborder
 * @property string $tel_no
 * @property string $salesman
 * @property string $brand
 * @property string $model
 * @property string $description
 * @property string $serial_no
 * @property string $received_by
 * @property string $receiver_name
 * @property string $problem
 * @property string $tech_finding
 * @property string $tech_action_taken
 * @property string $tech_spare_part
 * @property string $done_by
 * @property string $date_done_by
 * @property string $checked_by
 * @property string $date_checked_by
 * @property string $send_out_by
 * @property string $date_send_out_by
 * @property string $remark
 * @property string $status
 */
class JobOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    
    public static function tableName()
    {
        return 'job_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['customer_id', 'customer_name', 'job_order_no', 'date_joborder', 'tel_no', 'salesman', 'brand', 'model', 'description', 'serial_no', 'received_by', 'receiver_name', 'problem', 'tech_finding', 'tech_action_taken', 'tech_spare_part', 'done_by', 'date_done_by', 'checked_by', 'date_checked_by', 'send_out_by', 'date_send_out_by', 'remark'], 'required'],
            [['description', 'tech_finding', 'tech_action_taken', 'tech_spare_part', 'remark', 'status','item_quote'], 'string'],
            [['customer_name', 'job_order_no', 'salesman', 'brand', 'model', 'serial_no', 'receiver_name', 'done_by', 'checked_by', 'send_out_by','email','other_problem','accessory','other_received_by'], 'string', 'max' => 300],
            [['tel_no', 'date_done_by', 'date_checked_by', 'date_send_out_by'], 'string', 'max' => 50],
            [['created_at', 'updated_at'], 'safe'],
            [['enter_by','updated_by','customer_id','render_state_id','module_id','indoor'], 'integer'],
            [['received_by', 'problem'], 'string', 'max' => 200],
            [['date_joborder'],'string','max'=>100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Company Name',
            'customer_name' => 'Customer Person In Charge',
            'job_order_no' => 'Job Order No',
            'date_joborder' => 'Date Job Order',
            'tel_no' => 'Telephone No',
            'salesman' => 'Salesman',
            'brand' => 'Brand',
            'model' => 'Model',
            'description' => 'Description',
            'serial_no' => 'Serial Number',
            'received_by' => 'Received By',
            'receiver_name' => 'Receiver Name',
            'problem' => 'Problem',
            'tech_finding' => 'Finding',
            'tech_action_taken' => 'Technical Action Taken',
            'tech_spare_part' => 'Spare Part Needed',
            'done_by' => 'Done By',
            'date_done_by' => 'Date Done',
            'checked_by' => 'Checked By',
            'date_checked_by' => 'Date Checked',
            'send_out_by' => 'Send Out By',
            'date_send_out_by' => 'Date Send Out',
            'remark' => 'Remark To Customer',
            'status' => 'Status',
            'email'=>'Customer Email',
            'accessory'=>'Accessory',
            'other_received_by'=>'Other Received By',
            'indoor'=>'Indoor',
        ];
    }

    public function getCustname()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    public function getState()
    {
        return $this->hasOne(LookupState::className(),['id'=>'render_state_id']);
    }

    public function getPersonname()
    {
        return $this->hasOne(CustomerPic::className(),['id'=>'customer_name']);
    }

    public function getPic()
    {
        return $this->hasOne(LookupSalesman::className(),['user_id'=>'salesman']);
    }

    public function getIndoorname()
    {
        return $this->hasOne(LookupIndoor::className(),['user_id'=>'indoor']);
    }

    public static function joborder()
    {
            
        $user =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT COUNT(id) AS totalJoborder FROM notify_joborder WHERE DATE_FORMAT(date_receive,'%Y-%m-%d') = CURDATE() AND user_id = '".$user."' AND read_notify = 'unread'");
        $data = $sql->queryAll();

        return $data;

    }

    public static function joborderlist()
    {
         $user =  Yii::$app->user->identity->id;

        $connection = \Yii::$app->db;

        $sql = $connection->createCommand("SELECT n.*,j.id AS jobid,j.job_order_no FROM notify_joborder n LEFT JOIN job_order j on j.id = n.job_order_id WHERE n.user_id = '".$user."' ORDER BY n.date_receive DESC");
                $data = $sql->queryAll();

        return $data;

    }

    public static function troubleshoot($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Awaiting Troubleshoot' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function wip($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Work In Progress' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function wc($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Warranty Claim' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function aq($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Awaiting To Quote' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function br($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Beyond Repair' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function cc($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Customer Confirm' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function cr($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Customer Reject' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function asp($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Awaiting Spare Part' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function ad($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Arrange Delivery' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function ss($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Send To Supplier' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
    public static function quote($render_state_id)
    {
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT COUNT(id) FROM job_order WHERE status = 'Quoted' and render_state_id = ".$render_state_id);
                $data = $sql->queryScalar();

        return $data;

    }
}
