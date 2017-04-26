<?php

namespace frontend\modules\malaysia\models;

use Yii;
use common\models\LookupAgent;
use common\models\LookupTerm;
use common\models\LookupArea;
use common\models\LookupStax;
use frontend\models\User;
use common\models\LookupState;
use common\models\LookupCountry;
/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $cust_code
 * @property string $company_name
 * @property string $address
 * @property string $country_code_phone
 * @property string $area_code_phone
 * @property string $telephone_no
 * @property string $crlimit
 * @property integer $term_id
 * @property integer $area_code_id
 * @property integer $agent_id
 * @property integer $staxcode_id
 * @property string $postcode
 * @property string $city
 * @property integer $state_id
 * @property integer $country_id
 * @property string $country_code_fax
 * @property string $area_code_fax
 * @property string $fax_no
 * @property string $email
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $render_state_id
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['term_id', 'area_code_id', 'agent_id', 'staxcode_id', 'state_id', 'country_id', 'enter_by', 'update_by', 'render_state_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['cust_code'], 'string', 'max' => 100],
            [['company_name', 'email'], 'string', 'max' => 255],
            [['country_code_phone', 'area_code_phone', 'postcode', 'country_code_fax', 'area_code_fax'], 'string', 'max' => 20],
            [['telephone_no', 'crlimit', 'city', 'fax_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cust_code' => 'Cust Code',
            'company_name' => 'COMPANY NAME',
            'address' => 'Address',
            'country_code_phone' => 'Country Code Phone',
            'area_code_phone' => 'Area Code Phone',
            'telephone_no' => 'Telephone No',
            'crlimit' => 'Crlimit',
            'term_id' => 'Term',
            'area_code_id' => 'Area Code',
            'agent_id' => 'Agent',
            'staxcode_id' => 'Staxcode',
            'postcode' => 'Postcode',
            'city' => 'City',
            'state_id' => 'State',
            'country_id' => 'Country',
            'country_code_fax' => 'Country Code Fax',
            'area_code_fax' => 'Area Code Fax',
            'fax_no' => 'Fax No',
            'email' => 'Email',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'render_state_id' => 'Render State',
        ];
    }

    public function getSales()
    {
        return $this->hasOne(LookupAgent::className(), ['id' => 'agent_id']);
    }
    public function getArea()
    {
        return $this->hasOne(LookupArea::className(), ['id' => 'area_code_id']);
    }
    public function getTerm()
    {
        return $this->hasOne(LookupTerm::className(), ['id' => 'term_id']);
    }
    public function getStax()
    {
        return $this->hasOne(LookupStax::className(), ['id' => 'staxcode_id']);
    }

    public function getState()
    {
        return $this->hasOne(LookupState::className(), ['id' => 'state_id']);
    }
    public function getCountry()
    {
        return $this->hasOne(LookupCountry::className(), ['id' => 'country_id']);
    }

    public function getEnter()
    {
        return $this->hasOne(User::className(), ['id' => 'enter_by']);
    }



    
}
