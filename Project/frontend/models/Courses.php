<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $course_name
 * @property int $course_type_id
 * @property string $course_description
 * @property string $keywords
 * @property int $status 0 - Inactive, 1 - Active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BlockedCourses[] $blockedCourses
 * @property MasterCourseTypes $courseType
 * @property CoursesAssigned[] $coursesAssigneds
 * @property DefaultLessonComplete[] $defaultLessonCompletes
 * @property Ebooks[] $ebooks
 * @property Lessons[] $lessons
 * @property ReviewMaterial[] $reviewMaterials
 * @property Tiles[] $tiles
 */
class Courses extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['course_name', 'course_type_id', 'course_description', 'status', 'created_at', 'updated_at'], 'required'],
            [['course_type_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['course_description'], 'string', 'length' => [50, 1000], 'message' => "Course Description should contain atleast 50 characters."],
            [['course_name'], 'string', 'length' => [2, 40], 'message' => "Course Name should contain atleast 2 characters."],
            ['course_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-\s\.]/', 'message' => "Invalid Course Name!, Please enter valid Course Name."],
            [['course_code'], 'string', 'max' => 20],
            [['keywords'], 'string', 'max' => 255],
            [['course_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterCourseTypes::className(), 'targetAttribute' => ['course_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'course_name' => 'Course Name',
            'course_type_id' => 'Course Type ID',
            'course_description' => 'Course Description',
            'keywords' => 'Keywords',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockedCourses() {
        return $this->hasMany(BlockedCourses::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseType() {
        return $this->hasOne(MasterCourseTypes::className(), ['id' => 'course_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAssigneds() {
        return $this->hasMany(CoursesAssigned::className(), ['courses_assigned' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLessonCompletes() {
        return $this->hasMany(DefaultLessonComplete::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEbooks() {
        return $this->hasMany(Ebooks::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons() {
        return $this->hasMany(Lessons::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterials() {
        return $this->hasMany(ReviewMaterial::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiles() {
        return $this->hasMany(Tiles::className(), ['course_id' => 'id']);
    }

}
