<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "upload_invoice".
 *
 * @property integer $id
 * @property string $excel_directory
 * @property string $entry
 * @property string $tarikh
 * @property integer $upload_by
 * @property integer $state_id
 * @property string $filename
 */
class UploadInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upload_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entry'], 'safe'],
            [['upload_by', 'state_id'], 'integer'],
            [['excel_directory'], 'string', 'max' => 255],
            [['tarikh'], 'string', 'max' => 20],
            [['filename'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'excel_directory' => 'Excel Directory',
            'entry' => 'Entry',
            'tarikh' => 'Tarikh',
            'upload_by' => 'Upload By',
            'state_id' => 'State ID',
            'filename' => 'Filename',
        ];
    }
}
