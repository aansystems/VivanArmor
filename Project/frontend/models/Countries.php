<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $sortname
 * @property string $country_name
 * @property int $phonecode
 *
 * @property Address[] $addresses
 * @property States[] $states
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sortname', 'country_name', 'phonecode'], 'required'],
            [['phonecode'], 'integer'],
            [['sortname'], 'string', 'max' => 3],
            [['country_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sortname' => 'Sortname',
            'country_name' => 'Country Name',
            'phonecode' => 'Phonecode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['country' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(States::className(), ['country_id' => 'id']);
    }
}
