<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property int $country
 * @property int $state
 * @property int $city
 * @property string $street
 * @property int $pincode
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Countries $country0
 * @property States $state0
 * @property Cities $city0
 * @property Company[] $companies
 * @property Learners[] $learners
 */
class Address extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['country', 'state', 'city', 'street', 'pincode', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['country', 'state', 'city', 'pincode', 'created_by', 'updated_by'], 'integer'],
            [['street'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_at'], 'required', 'on' => 'create'],
            [['street'], 'string', 'length' => [5, 255], 'message' => "Street should coantain at least 5 characters."],
            [['pincode'], 'match', 'pattern' => '/^\d{5,6}$/', 'message' => 'Invalid Pincode!, Please enter valid Pincode.'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country' => 'id']],
            [['state'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['state' => 'id']],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'street' => 'Street',
            'pincode' => 'Pincode',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0() {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0() {
        return $this->hasOne(States::className(), ['id' => 'state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0() {
        return $this->hasOne(Cities::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies() {
        return $this->hasMany(Company::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearners() {
        return $this->hasMany(Learners::className(), ['address_id' => 'id']);
    }

}
