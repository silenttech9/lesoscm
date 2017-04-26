<?php

namespace frontend\modules\malaysia\models;

use Yii;

/**
 * This is the model class for table "johor_invoice".
 *
 * @property integer $id
 * @property string $date
 * @property string $ref_no
 * @property string $item_no
 * @property resource $description
 * @property string $quantity
 * @property string $selling_price
 * @property string $amount
 * @property string $company_name
 * @property string $agent
 * @property string $status
 */
class JohorInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'johor_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date', 'ref_no', 'item_no', 'quantity', 'selling_price', 'amount', 'company_name', 'agent', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'ref_no' => 'Ref No',
            'item_no' => 'Item No',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'selling_price' => 'Selling Price',
            'amount' => 'Amount',
            'company_name' => 'Company Name',
            'agent' => 'Agent',
            'status' => 'Status',
        ];
    }
    
    public static function getDb() {
        return Yii::$app->db2;
    }
}
