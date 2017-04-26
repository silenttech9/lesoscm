<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_program_product".
 *
 * @property integer $id
 * @property string $program_product
 * @property integer $state_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class LookupProgramProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_program_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id', 'enter_by', 'update_by'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['program_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_product' => 'Program Product',
            'state_id' => 'State ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
