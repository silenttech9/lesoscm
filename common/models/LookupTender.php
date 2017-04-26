<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_tender".
 *
 * @property integer $id
 * @property string $tender
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class LookupTender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_tender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by','module_id'], 'integer'],
            [['tender'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tender' => 'Tender',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
