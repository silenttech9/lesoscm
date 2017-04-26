<?php

namespace frontend\modules\malaysia\models;

use Yii;

/**
 * This is the model class for table "selangor_stock".
 *
 * @property integer $id
 * @property string $ITEM_NO
 * @property string $DESCRIPTION
 * @property string $LOCATION
 * @property string $BAL
 * @property string $UNIT_COST
 * @property string $TOTAL_COST
 */
class SelangorStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'selangor_stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_NO', 'DESCRIPTION', 'LOCATION', 'BAL', 'UNIT_COST', 'TOTAL_COST'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ITEM_NO' => 'ITEM NO',
            'DESCRIPTION' => 'DESCRIPTION',
            'LOCATION' => 'LOCATION',
            'BAL' => 'BALANCE',
            'UNIT_COST' => 'Unit  Cost',
            'TOTAL_COST' => 'Total  Cost',
        ];
    }
}
