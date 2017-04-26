<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_delivery_mode".
 *
 * @property integer $id
 * @property string $delivery_type
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class LookupDeliveryMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_delivery_mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by','module_id'], 'integer'],
            [['delivery_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_type' => 'Delivery Type',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module'
        ];
    }
}
