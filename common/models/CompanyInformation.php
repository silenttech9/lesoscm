<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_information".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $registeration_no
 * @property string $gst_no
 * @property string $address
 * @property integer $state_id
 * @property string $telephone_no1
 * @property string $telephone_no2
 * @property string $telephone_no3
 * @property string $telephone_no4
 * @property string $fax_no
 * @property string $email
 */
class CompanyInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['state_id'], 'integer'],
            [['company_name', 'email'], 'string', 'max' => 255],
            [['registeration_no', 'gst_no', 'telephone_no1', 'telephone_no2', 'telephone_no3', 'telephone_no4', 'fax_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'registeration_no' => 'Registeration No',
            'gst_no' => 'Gst No',
            'address' => 'Address',
            'state_id' => 'State ID',
            'telephone_no1' => 'Telephone No1',
            'telephone_no2' => 'Telephone No2',
            'telephone_no3' => 'Telephone No3',
            'telephone_no4' => 'Telephone No4',
            'fax_no' => 'Fax No',
            'email' => 'Email',
        ];
    }
}
