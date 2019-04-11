<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $company_name
 * @property int $area_code
 * @property string $fax
 * @property string $website
 * @property int $users_license
 * @property string $remarks
 * @property int $company_admin_id
 * @property int $address_id
 * @property int $status 0 - Inactive, 1 - Active
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property Branches[] $branches
 * @property User $companyAdmin
 * @property Address $address
 * @property User $createdBy
 * @property User $updatedBy
 */
class Company extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['company_name', 'website', 'users_license', 'remarks', 'company_admin_id', 'address_id', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['area_code', 'users_license', 'company_admin_id', 'address_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['remarks'], 'string', 'length' => [5, 255], 'message' => "Remarks should contain atleast 5 characters."],
            [['created_at', 'updated_at'], 'safe'],
            [['company_name'], 'filter', 'filter' => 'ucfirst'],
            [['company_name'], 'string', 'length' => [2, 255], 'message' => "CompanyName should contain atleast 2 characters."],
            ['company_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-\s]/', 'message' => "Invalid Company Name!, Please enter valid Company Name."],
            [['fax'], 'match', 'pattern' => '/^\d{6,10}$/', 'message' => 'Invalid Fax Number!, Please enter valid Fax Number.'],
            [['website'], 'string', 'max' => 20],
            ['website', 'url', 'defaultScheme' => 'http'],
            ['website', 'match', 'not' => false, 'pattern' => '/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)/', 'message' => 'Invalid Website!, Please enter valid Website.'],
            ['url', 'filter', 'filter' => 'trim'],
            [['users_license'], 'match', 'not' => false, 'pattern' => '/^[0-9]{0,3}$/', 'message' => 'Invalid Number!, Please enter valid Number for License.'],
            [['company_admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['company_admin_id' => 'id']],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['address_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'area_code' => 'Area Code',
            'fax' => 'Fax',
            'website' => 'Website',
            'users_license' => 'Users License',
           
            'remarks' => 'Remarks',
            'company_admin_id' => 'Company Admin ID',
            'address_id' => 'Address ID',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches() {
        return $this->hasMany(Branches::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyAdmin() {
        return $this->hasOne(User::className(), ['id' => 'company_admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress() {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
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
    
  

}
