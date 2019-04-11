<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_payment_types".
 *
 * @property int $id
 * @property string $payment_type
 */
class MasterPaymentTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_payment_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_type'], 'required'],
            [['payment_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_type' => 'Payment Type',
        ];
    }
}
