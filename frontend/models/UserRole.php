<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_role".
 *
 * @property integer $id
 * @property string $user_role
 * @property integer $user_id
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_role'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_role' => 'User Role',
            'user_id' => 'User ID',
        ];
    }
}
