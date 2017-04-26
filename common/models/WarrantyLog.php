<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warranty_log".
 *
 * @property integer $id
 * @property integer $user
 * @property string $date_process
 * @property integer $warranty_id
 * @property string $action
 */
class WarrantyLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warranty_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user', 'warranty_id','invoice_id'], 'integer'],
            [['date_process', 'action'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user' => 'User',
            'date_process' => 'Date Process',
            'warranty_id' => 'Warranty ID',
            'action' => 'Action',
        ];
    }
}
