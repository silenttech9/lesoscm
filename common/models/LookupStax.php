<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_stax".
 *
 * @property integer $id
 * @property string $CODE
 * @property string $DESC2
 * @property string $DESC
 */
class LookupStax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_stax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [['date_create', 'date_update'], 'safe'],
            [['CODE'], 'string', 'max' => 8],
            [['DESC2', 'DESC'], 'string', 'max' => 200],
            [['enter_by', 'update_by','module_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CODE' => 'Code',
            'DESC2' => 'Desc2',
            'DESC' => 'Desc',
            'module_id' => 'Module ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
