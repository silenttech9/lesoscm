<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_invitation".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $address_1
 * @property string $address_2
 * @property string $address_3
 * @property string $state
 * @property string $email
 * @property integer $event_id
 * @property string $created_at
 * @property integer $enter_by
 */
class EventInvitation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_invitation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'enter_by'], 'integer'],
            [['company_name', 'address_1', 'address_2', 'address_3', 'state', 'email','name'], 'string', 'max' => 300],
            [['created_at','status_email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name'=>'Name',
            'company_name' => 'Company Name',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'address_3' => 'Address 3',
            'state' => 'State',
            'email' => 'Email',
            'event_id' => 'Event ID',
            'created_at' => 'Created At',
            'enter_by' => 'Enter By',
            'status_email'=>'Send Email',
        ];
    }
}
