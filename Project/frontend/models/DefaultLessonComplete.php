<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "default_lesson_complete".
 *
 * @property int $id
 * @property int $learner_id
 * @property int $course_id
 * @property int $completion_status 0 - Not Completed, 1 - Completed
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Courses $course
 * @property User $createdBy
 * @property User $updatedBy
 * @property Learners $learner
 */
class DefaultLessonComplete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'default_lesson_complete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'course_id', 'completion_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['learner_id', 'course_id', 'completion_status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Learners::className(), 'targetAttribute' => ['learner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'learner_id' => 'Learner ID',
            'course_id' => 'Course ID',
            'completion_status' => 'Completion Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearner()
    {
        return $this->hasOne(Learners::className(), ['id' => 'learner_id']);
    }
}
