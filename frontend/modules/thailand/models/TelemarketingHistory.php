<?php

namespace frontend\modules\thailand\models;

use Yii;

/**
 * This is the model class for table "telemarketing_history".
 *
 * @property integer $id
 * @property string $history
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $id_telemarketing_customer
 */
class TelemarketingHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telemarketing_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['history'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by', 'id_telemarketing_customer'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'history' => 'History',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'id_telemarketing_customer' => 'Id Telemarketing Customer',
        ];
    }
}
