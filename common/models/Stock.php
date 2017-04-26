<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property string $brand
 * @property string $ITEM_NO
 * @property resource $DESCRIPTION
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DESCRIPTION'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['enter_by', 'update_by'], 'integer'],
            [['brand', 'ITEM_NO'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'BRAND',
            'ITEM_NO' => 'ITEM NO',
            'DESCRIPTION' => 'DESCRIPTION',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
