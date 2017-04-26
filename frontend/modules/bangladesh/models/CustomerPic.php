<?php

namespace frontend\modules\bangladesh\models;

use Yii;

/**
 * This is the model class for table "customer_pic".
 *
 * @property integer $id
 * @property string $name
 * @property string $department
 * @property string $country_code_phone
 * @property string $area_code_phone
 * @property string $telephone_no
 * @property string $extension
 * @property string $country_code_mobile
 * @property string $area_code_mobile
 * @property string $mobile_no
 * @property string $email
 * @property string $customer_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class CustomerPic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_pic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by'], 'integer'],
            [['name', 'department', 'email'], 'string', 'max' => 255],
            [['country_code_phone', 'area_code_phone', 'extension', 'country_code_mobile', 'area_code_mobile'], 'string', 'max' => 20],
            [['telephone_no', 'mobile_no', 'customer_id'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'department' => 'Department',
            'country_code_phone' => 'Country Code Phone',
            'area_code_phone' => 'Area Code Phone',
            'telephone_no' => 'Telephone No',
            'extension' => 'Extension',
            'country_code_mobile' => 'Country Code Mobile',
            'area_code_mobile' => 'Area Code Mobile',
            'mobile_no' => 'Mobile No',
            'email' => 'Email',
            'customer_id' => 'Customer Name',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
