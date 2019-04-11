<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_course_types".
 *
 * @property int $id
 * @property string $course_type_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Courses[] $courses
 */
class MasterCourseTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_course_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_type_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['course_type_name'], 'string','length'=>[2,125], 'message'=>"Course Type Name should contain atleast 2 characters."],
            ['course_type_name', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z\s_-]/', 'message'=>"Invalid Course Type Name!, Please enter valid Course Type Name."],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_type_name' => 'Course Type Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['course_type_id' => 'id']);
    }
}
