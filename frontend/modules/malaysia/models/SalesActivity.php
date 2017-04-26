<?php

namespace frontend\modules\malaysia\models;

use Yii;
use common\models\LookupState;
use frontend\modules\malaysia\models\Customer;
use frontend\modules\malaysia\models\CustomerPic;
use frontend\models\User;
/**
 * This is the model class for table "sales_activity".
 *
 * @property integer $id
 * @property string $datetime
 * @property integer $customer_id
 * @property integer $state_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class SalesActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'state_id', 'enter_by', 'update_by','module_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['customer_id'], 'required','message'=>'Please Choose Customer'],
            [['datetime'], 'string', 'max' => 50],
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
            'state_id' => 'State',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    public function getState()
    {
        return $this->hasOne(LookupState::className(), ['id' => 'state_id']);
    }
    public function getEnterby()
    {
        return $this->hasOne(User::className(), ['id' => 'enter_by']);
    }


}
