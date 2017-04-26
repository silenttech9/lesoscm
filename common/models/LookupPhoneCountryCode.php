<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lookup_phone_country_code".
 *
 * @property integer $id
 * @property string $country
 * @property string $code
 * @property string $active
 */
class LookupPhoneCountryCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_phone_country_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'string'],
            [['country'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'code' => 'Code',
            'active' => 'Active',
        ];
    }
}
