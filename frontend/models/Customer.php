<?php

namespace frontend\models;

use Yii;

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
 * @property integer $module_id
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
            [['term_id', 'area_code_id', 'agent_id', 'staxcode_id', 'state_id', 'country_id', 'enter_by', 'update_by', 'render_state_id', 'module_id'], 'integer'],
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
            'company_name' => 'Company Name',
            'address' => 'Address',
            'country_code_phone' => 'Country Code Phone',
            'area_code_phone' => 'Area Code Phone',
            'telephone_no' => 'Telephone No',
            'crlimit' => 'Crlimit',
            'term_id' => 'Term ID',
            'area_code_id' => 'Area Code ID',
            'agent_id' => 'Agent ID',
            'staxcode_id' => 'Staxcode ID',
            'postcode' => 'Postcode',
            'city' => 'City',
            'state_id' => 'State ID',
            'country_id' => 'Country ID',
            'country_code_fax' => 'Country Code Fax',
            'area_code_fax' => 'Area Code Fax',
            'fax_no' => 'Fax No',
            'email' => 'Email',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'render_state_id' => 'Render State ID',
            'module_id' => 'Module ID',
        ];
    }
}
