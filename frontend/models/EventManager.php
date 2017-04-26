<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "event_manager".
 *
 * @property integer $id
 * @property string $title
 * @property string $date_event
 * @property string $time_event_start
 * @property string $time_event_end
 * @property string $venue_event
 * @property string $objective_event
 * @property integer $max_participant_perevent
 * @property integer $max_participant_percompany
 * @property string $fee_event
 * @property string $incentive_company
 * @property string $incentive_attendee
 * @property string $reg_due_date
 * @property string $img_brochure
 * @property integer $enter_by
 * @property string $created_at
 */
class EventManager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'event_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objective_event','address_event'], 'string'],
            [['max_participant_perevent', 'max_participant_percompany', 'enter_by'], 'integer'],
            [['title', 'venue_event', 'img_brochure','organizer_email','organizer_name'], 'string', 'max' => 300],
            [['organizer_email'],'email'],
            [['date_event', 'time_event_start', 'time_event_end', 'fee_event', 'incentive_company', 'incentive_attendee', 'reg_due_date', 'created_at','phone_organizer','status_event'], 'string', 'max' => 100],
            [['file'],'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date_event' => 'Date Event',
            'time_event_start' => 'Time Event Start',
            'time_event_end' => 'Time Event End',
            'venue_event' => 'Venue Event',
            'objective_event' => 'Objective Event',
            'max_participant_perevent' => 'Maximum Participant Per Event',
            'max_participant_percompany' => 'Maximum Participant Per Company',
            'fee_event' => 'Fee Event',
            'incentive_company' => 'Incentive Company',
            'incentive_attendee' => 'Incentive Attendee',
            'reg_due_date' => 'Registration Due Date',
            'img_brochure' => 'Event Brochure',
            'enter_by' => 'Enter By',
            'created_at' => 'Created At',
            'file'=>'Image Brochure',
            'status_event'=>'Status Event',
            'organizer_name'=>'Organizer Name',
        ];
    }
}
