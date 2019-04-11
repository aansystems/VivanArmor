<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $role_type
 * @property string $email
 * @property int $phone_code
 * @property string $phone
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property int $status
 * @property int $added_by 0-Course Admin, 1-Branch Manager
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Address[] $addresses
 * @property Address[] $addresses0
 * @property BlockedCourses[] $blockedCourses
 * @property BlockedCourses[] $blockedCourses0
 * @property BranchManagers[] $branchManagers
 * @property BranchManagers[] $branchManagers0
 * @property BranchManagers[] $branchManagers1
 * @property Branches[] $branches
 * @property Branches[] $branches0
 * @property Company[] $companies
 * @property Company[] $companies0
 * @property Company[] $companies1
 * @property CompanyNotifications[] $companyNotifications
 * @property CompanyNotifications[] $companyNotifications0
 * @property CompanyNotifications[] $companyNotifications1
 * @property CompanyNotifications[] $companyNotifications2
 * @property CoursesAssigned[] $coursesAssigneds
 * @property CoursesAssigned[] $coursesAssigneds0
 * @property CoursesAssigned[] $coursesAssigneds1
 * @property DefaultLessonComplete[] $defaultLessonCompletes
 * @property DefaultLessonComplete[] $defaultLessonCompletes0
 * @property LearnerActivity[] $learnerActivities
 * @property LearnerActivity[] $learnerActivities0
 * @property LearnerScoring[] $learnerScorings
 * @property LearnerScoring[] $learnerScorings0
 * @property Learners[] $learners
 * @property Learners[] $learners0
 * @property Learners[] $learners1
 * @property MasterRoleTypes[] $masterRoleTypes
 * @property MasterRoleTypes[] $masterRoleTypes0
 * @property ReviewMaterialScoring[] $reviewMaterialScorings
 * @property ReviewMaterialScoring[] $reviewMaterialScorings0
 * @property SuperAdminNotifications[] $superAdminNotifications
 * @property SuperAdminNotifications[] $superAdminNotifications0
 * @property SuperAdminNotifications[] $superAdminNotifications1
 * @property SuperAdminNotifications[] $superAdminNotifications2
 * @property TilesAssigned[] $tilesAssigneds
 * @property TilesAssigned[] $tilesAssigneds0
 * @property TilesAssigned[] $tilesAssigneds1
 * @property MasterRoleTypes $roleType
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['first_name','privilege', 'role_type', 'email', 'auth_key', 'password_hash',  'created_by', 'updated_at', 'updated_by'], 'required'],
            [['role_type', 'phone_code','privilege','two_fact', 'status', 'added_by', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_at'], 'required', 'on' => 'create'],
            [['first_name'], 'string', 'length' => [2, 32], 'message' => "FirstName should contain atleast 2 characters."],
//            [['last_name'], 'string', 'length' => [2, 32], 'message' => "LastName should contain atleast 2 characters."],
            ['first_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s_-]/', 'message' => "Invalid Firstname!, Please enter valid Firstname."],
//            ['last_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s_-]/', 'message' => "Invalid Lastname!, Please enter valid Lastname."],
            [['first_name', 'last_name'], 'filter', 'filter' => 'ucfirst', 'message' => 'Fristname should be Caps!'],
            ['email', 'email'],
            ['phone_code', 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'match', 'pattern' => '/^(([^-<>()\/[\]\\.,;:\s~`!#$%^&*_?+=|@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', 'message' => "Invalid Email!, Please enter valid Email."],
            //[['email'], 'unique', 'targetClass' => self::class, 'message' => 'This email already exists'],
            [['phone'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'Invalid Mobile Number!, Please enter valid Mobile Number.'],
            [['email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['role_type'], 'exist', 'skipOnError' => true, 'targetClass' => MasterRoleTypes::className(), 'targetAttribute' => ['role_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'role_type' => 'Role Type',
            'email' => 'Email',
            'phone_code' => 'Phone Code',
            'phone' => 'Mobile Number',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'added_by' => 'Added By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses() {
        return $this->hasMany(Address::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses0() {
        return $this->hasMany(Address::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockedCourses() {
        return $this->hasMany(BlockedCourses::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockedCourses0() {
        return $this->hasMany(BlockedCourses::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchManagers() {
        return $this->hasMany(BranchManagers::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchManagers0() {
        return $this->hasMany(BranchManagers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchManagers1() {
        return $this->hasMany(BranchManagers::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches() {
        return $this->hasMany(Branches::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches0() {
        return $this->hasMany(Branches::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies() {
        return $this->hasMany(Company::className(), ['company_admin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies0() {
        return $this->hasMany(Company::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies1() {
        return $this->hasMany(Company::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyNotifications() {
        return $this->hasMany(CompanyNotifications::className(), ['assigned_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyNotifications0() {
        return $this->hasMany(CompanyNotifications::className(), ['assigned_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyNotifications1() {
        return $this->hasMany(CompanyNotifications::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyNotifications2() {
        return $this->hasMany(CompanyNotifications::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAssigneds() {
        return $this->hasMany(CoursesAssigned::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAssigneds0() {
        return $this->hasMany(CoursesAssigned::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAssigneds1() {
        return $this->hasMany(CoursesAssigned::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLessonCompletes() {
        return $this->hasMany(DefaultLessonComplete::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLessonCompletes0() {
        return $this->hasMany(DefaultLessonComplete::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerActivities() {
        return $this->hasMany(LearnerActivity::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerActivities0() {
        return $this->hasMany(LearnerActivity::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerScorings() {
        return $this->hasMany(LearnerScoring::className(), ['learner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerScorings0() {
        return $this->hasMany(LearnerScoring::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearners() {
        return $this->hasMany(Learners::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearners0() {
        return $this->hasMany(Learners::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearners1() {
        return $this->hasMany(Learners::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterRoleTypes() {
        return $this->hasMany(MasterRoleTypes::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterRoleTypes0() {
        return $this->hasMany(MasterRoleTypes::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterialScorings() {
        return $this->hasMany(ReviewMaterialScoring::className(), ['learner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterialScorings0() {
        return $this->hasMany(ReviewMaterialScoring::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperAdminNotifications() {
        return $this->hasMany(SuperAdminNotifications::className(), ['assigned_from' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperAdminNotifications0() {
        return $this->hasMany(SuperAdminNotifications::className(), ['assigned_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperAdminNotifications1() {
        return $this->hasMany(SuperAdminNotifications::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperAdminNotifications2() {
        return $this->hasMany(SuperAdminNotifications::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTilesAssigneds() {
        return $this->hasMany(TilesAssigned::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTilesAssigneds0() {
        return $this->hasMany(TilesAssigned::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTilesAssigneds1() {
        return $this->hasMany(TilesAssigned::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleType() {
        return $this->hasOne(MasterRoleTypes::className(), ['id' => 'role_type']);
    }

}
