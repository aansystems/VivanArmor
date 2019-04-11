<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "learners".
 *
 * @property int $id
 * @property int $user_id
 * @property int $address_id
 * @property string $alternate_email
 * @property string $alternate_phone
 * @property string $designation
 * @property string $company_contact_person
 * @property int $payment_type
 * @property string $remarks
 * @property int $status 0 - Inactive, 1 - Active
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property DefaultLessonComplete[] $defaultLessonCompletes
 * @property LearnerActivity[] $learnerActivities
 * @property User $user
 * @property Address $address
 * @property User $createdBy
 * @property User $updatedBy
 */
class Learners extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'learners';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['user_id', 'address_id', 'designation', 'status', 'created_by', 'updated_at', 'updated_by'], 'required'],
                [['user_id', 'address_id', 'payment_type', 'status', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['created_at'], 'required', 'on' => 'create'],
                [['alternate_email', 'alternate_phone', 'remarks'], 'string', 'max' => 40],
                ['alternate_email', 'email'],
                ['alternate_email', 'filter', 'filter' => 'trim'],
                ['alternate_email', 'match', 'pattern' => '/^(([^-<>()\/[\]\\.,;:\s~`!#$%^&*_?+=|@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', 'message' => "Invalid Alternate Email!, Please enter valid Alternate Email."],
                [['designation'], 'string', 'length' => [2, 32], 'message' => "Designation should contain atleast 2 characters."],
                ['designation', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s_-]/', 'message' => "Invalid Designation!, Please enter valid Designation."],
                [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'address_id' => 'Address ID',
            'alternate_email' => 'Alternate Email',
            'alternate_phone' => 'Alternate Phone',
            'designation' => 'Designation',            
            'payment_type' => 'Payment Type',
            'remarks' => 'Remarks',
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
    public function getDefaultLessonCompletes() {
        return $this->hasMany(DefaultLessonComplete::className(), ['learner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerActivities() {
        return $this->hasMany(LearnerActivity::className(), ['learner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
