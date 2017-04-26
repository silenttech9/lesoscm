<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_state_akses".
 *
 * @property integer $id
 * @property integer $state_akses
 * @property integer $user_id
 */
class UserStateAkses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_state_akses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_akses', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state_akses' => 'State Akses',
            'user_id' => 'User ID',
        ];
    }
}
