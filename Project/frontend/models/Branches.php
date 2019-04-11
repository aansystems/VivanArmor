<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $id
 * @property string $branch_name
 * @property int $company_id
 * @property int $status 0 - Inactive, 1 - Active
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property BranchManagers[] $branchManagers
 * @property Company $company
 * @property User $createdBy
 * @property User $updatedBy
 */
class Branches extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['branch_name', 'company_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['company_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['branch_name'], 'string', 'length' => [2, 255], 'message' => "Branch Name should contain atleast 2 characters."],
            ['branch_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-\s]/', 'message' => "Invalid Branch Name!, Please enter valid Branch Name"],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'branch_name' => 'Branch Name',
            'company_id' => 'Company ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchManagers() {
        return $this->hasMany(BranchManagers::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany() {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
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
