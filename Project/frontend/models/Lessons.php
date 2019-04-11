<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property int $id
 * @property int $course_id
 * @property string $lesson_name
 * @property int $sequence
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LearnerActivity[] $learnerActivities
 * @property Courses $course
 * @property Sections[] $sections
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'lesson_name', 'updated_at'], 'required'],
            [['course_id', 'sequence'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['lesson_name'], 'string', 'max' => 50],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'lesson_name' => 'Lesson Name',
            'sequence' => 'Sequence',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerActivities()
    {
        return $this->hasMany(LearnerActivity::className(), ['lesson_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['lesson_id' => 'id']);
    }
}
