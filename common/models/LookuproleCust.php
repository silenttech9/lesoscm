<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookuprole_cust".
 *
 * @property integer $id
 * @property string $role_cust
 */
class LookuproleCust extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookuprole_cust';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_cust'], 'required'],
            [['role_cust'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_cust' => 'Type of Customer',
        ];
    }
}
