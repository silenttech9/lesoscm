<?php

namespace frontend\modules\thailand\models;

use Yii;
use common\models\Stock;
use common\models\LookupUnitOfMeasure;
/**
 * This is the model class for table "quotation_details_thailand".
 *
 * @property integer $id
 * @property string $stock_id
 * @property resource $extra_description
 * @property integer $quantity
 * @property integer $unit
 * @property string $price
 * @property integer $quotation_id
 * @property string $temp
 */
class QuotationDetailsThailand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation_details_thailand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extra_description', 'temp'], 'string'],
            [['quantity', 'unit', 'quotation_id'], 'integer'],
            [['price'], 'number'],
            [['stock_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stock_id' => 'STOCK',
            'extra_description' => 'DESCRIPTION',
            'quantity' => 'QUANTITY',
            'unit' => 'UNIT',
            'price' => 'PRICE',
            'quotation_id' => 'Quotation ID',
            'temp' => 'Temp',
        ];
    }

        
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['id' => 'stock_id']);
    }

    public function getUom()
    {
        return $this->hasOne(LookupUnitOfMeasure::className(), ['id' => 'unit']);
    }

    
}
