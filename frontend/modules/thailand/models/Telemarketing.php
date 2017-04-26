<?php

namespace frontend\modules\thailand\models;

use Yii;
use common\models\LookupProgramProduct;
use common\models\LookupState;
use frontend\models\User;
/**
 * This is the model class for table "telemarketing".
 *
 * @property integer $id
 * @property string $datetime
 * @property integer $program_product_id
 * @property integer $telemarketers_id
 * @property integer $state_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 * @property integer $module_id
 */
class Telemarketing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'telemarketing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['program_product_id', 'telemarketers_id', 'state_id', 'enter_by', 'update_by', 'module_id'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['datetime'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Date Time',
            'program_product_id' => 'Program / Product',
            'telemarketers_id' => 'Telemarketers',
            'state_id' => 'State',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'module_id' => 'module_id'
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(LookupProgramProduct::className(), ['id' => 'program_product_id']);
    }
    public function getState()
    {
        return $this->hasOne(LookupState::className(), ['id' => 'state_id']);
    }
    public function getTelemarket()
    {
        return $this->hasOne(User::className(), ['id' => 'telemarketers_id']);
    }

    
}
