<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_currency".
 *
 * @property integer $id
 * @property string $currency_code
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $module_id
 */
class LookupCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by', 'module_id'], 'integer'],
            [['currency_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_code' => 'Currency Code',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'Module ID',
        ];
    }
}
