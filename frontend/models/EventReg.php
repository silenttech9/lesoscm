<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_reg".
 *
 * @property integer $id
 * @property string $company_info
 * @property string $company_name
 * @property string $address
 * @property integer $event_id
 * @property string $created_at
 */
class EventReg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_reg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name','address'], 'required', 'message' => 'This Field Is Compulsory'],
            [['address'], 'string'],
            [['event_id'], 'integer'],
            [['company_info', 'company_name'], 'string', 'max' => 300],
            [['created_at'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_info' => 'Company Info',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'event_id' => 'Event Title',
            'created_at' => 'Created At',
        ];
    }
}
