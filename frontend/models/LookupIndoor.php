<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lookup_indoor".
 *
 * @property integer $id
 * @property string $indoor
 * @property integer $user_id
 * @property integer $state_id
 * @property integer $module_id
 */
class LookupIndoor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_indoor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'state_id', 'module_id'], 'integer'],
            [['indoor'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'indoor' => 'Indoor',
            'user_id' => 'User ID',
            'state_id' => 'State ID',
            'module_id' => 'Module ID',
        ];
    }
}
