<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_agent".
 *
 * @property integer $id
 * @property string $agent
 * @property string $handphone_no
 * @property integer $state_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $module_id
 */
class LookupAgent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_agent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id', 'enter_by', 'update_by', 'module_id','user_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['agent'], 'string', 'max' => 255],
            [['handphone_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'agent' => 'Agent',
            'handphone_no' => 'Handphone No',
            'state_id' => 'State ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module ID',
        ];
    }
}
