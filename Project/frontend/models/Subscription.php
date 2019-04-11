<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id
 * @property string $type
 *
 * @property License[] $licenses
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicenses()
    {
        return $this->hasMany(License::className(), ['subscription_type' => 'id']);
    }
}
