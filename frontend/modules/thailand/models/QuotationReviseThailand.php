<?php

namespace frontend\modules\thailand\models;

use Yii;

/**
 * This is the model class for table "quotation_revise_thailand".
 *
 * @property integer $id
 * @property string $company_info
 * @property string $info_history_quotation
 * @property string $details_history_quotation
 * @property string $quotation_no
 * @property integer $quotation_id
 * @property string $date_create
 * @property string $date_update
 * @property integer $enter_by
 * @property integer $update_by
 */
class QuotationReviseThailand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation_revise_thailand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_info', 'info_history_quotation', 'details_history_quotation'], 'string'],
            [['quotation_id', 'enter_by', 'update_by'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['quotation_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_info' => 'Company Info',
            'info_history_quotation' => 'Info History Quotation',
            'details_history_quotation' => 'Details History Quotation',
            'quotation_no' => 'Quotation No',
            'quotation_id' => 'Quotation ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
