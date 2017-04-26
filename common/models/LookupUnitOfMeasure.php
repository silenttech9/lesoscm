<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_unit_of_measure".
 *
 * @property integer $id
 * @property string $unit_of_measure
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $module_id
 */
class LookupUnitOfMeasure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_unit_of_measure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enter_by', 'update_by', 'module_id'], 'integer'],
            [['unit_of_measure'], 'string', 'max' => 255],
            [['date_create', 'date_update'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_of_measure' => 'Unit Of Measure',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module ID',
        ];
    }
}
