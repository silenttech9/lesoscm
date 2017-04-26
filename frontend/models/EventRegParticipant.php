<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_reg_participant".
 *
 * @property integer $id
 * @property string $name_participant
 * @property string $email
 * @property string $designation
 * @property string $mobile_phone
 * @property integer $event_id
 * @property string $created_at
 * @property integer $eventreg_id
 * @property string $status
 */
class EventRegParticipant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_reg_participant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_participant','email','mobile_phone'], 'required', 'message' => 'This Field Is Compulsory'],
            [['event_id', 'eventreg_id'], 'integer'],
            [['name_participant'], 'string', 'max' => 300],
            [['email', 'designation'], 'string', 'max' => 255],
            [['email'],'email'],
            [['mobile_phone', 'created_at', 'status'], 'string', 'max' => 100],
            [['reminder'],'string','max'=>50],
            [['survey'],'string','max'=>10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_participant' => 'Name Participant',
            'email' => 'Email',
            'designation' => 'Designation',
            'mobile_phone' => 'Mobile Phone',
            'event_id' => 'Event ID',
            'created_at' => 'Created At',
            'eventreg_id' => 'Eventreg ID',
            'status' => 'Status',
        ];
    }

    public function getEventname()
    {
        return $this->hasOne(EventManager::className(), ['id' => 'event_id']);
    }

    public function getRegname()
    {
        return $this->hasOne(EventReg::className(),['id'=>'eventreg_id']);
    }
}
