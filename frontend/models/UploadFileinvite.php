<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "upload_fileinvite".
 *
 * @property integer $id
 * @property string $path
 * @property string $created_at
 * @property integer $upload_by
 */
class UploadFileinvite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;

    public static function tableName()
    {
        return 'upload_fileinvite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['upload_by','event_id'], 'integer'],
            [['path'], 'string', 'max' => 300],
            [['created_at'], 'string', 'max' => 100],
            [['file'],'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'created_at' => 'Created At',
            'upload_by' => 'Upload By',
            'file'=>''
        ];
    }
}
