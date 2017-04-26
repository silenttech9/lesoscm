<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lookup_salesman".
 *
 * @property integer $id
 * @property string $salesman
 * @property string $handphone_no
 */
class LookupSalesman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_salesman';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salesman'], 'string', 'max' => 22],
            [['handphone_no'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salesman' => 'Salesman',
            'handphone_no' => 'Handphone No',
        ];
    }
}
