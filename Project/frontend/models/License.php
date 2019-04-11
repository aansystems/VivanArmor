<?php

namespace frontend\models;
use frontend\models\Subscription;

use Yii;

/**
 * This is the model class for table "license".
 *
 * @property int $id
 * @property int $company_id
 * @property int $subscription_type
 * @property string $license_issued
 * @property string $license_expired
 * @property string $renewal_date
 * @property string $renewal_purpose
 *
 * @property Company $companyName
 * @property Subscription $subscriptionType
 */
class License extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'license';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'subscription_type', 'license_issued', 'license_expired', 'renewal_date', 'renewal_purpose', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['company_id', 'created_by', 'subscription_type', 'updated_by'], 'integer'],
            [['license_issued', 'license_expired', 'renewal_date', 'created_at', 'updated_at'],'safe'],
            [['renewal_purpose'], 'string'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['subscription_type'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::className(), 'targetAttribute' => ['subscription_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company Id',
            'subscription_type' => 'Subscription Type',
            'license_issued' => 'License Issued',
            'license_expired' => 'License Expired',
            'renewal_date' => 'Renewal Date',
            'renewal_purpose' => 'Renewal Purpose',
             'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At'

            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyName()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
    
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionType()
    {
        return $this->hasOne(Subscription::className(), ['id' => 'subscription_type']);
    }
    
     public function getUpdatedBy() {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
