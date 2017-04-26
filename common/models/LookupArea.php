<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_area".
 *
 * @property integer $id
 * @property string $area
 * @property string $desc
 * @property integer $state_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $module_id
 */
class LookupArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id', 'enter_by', 'update_by', 'module_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['area', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
            'desc' => 'Desc',
            'state_id' => 'State ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module ID',
        ];
    }
}
