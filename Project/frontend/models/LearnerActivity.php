<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "learner_activity".
 *
 * @property int $id
 * @property int $learner_id
 * @property int $lesson_id
 * @property int $section_id
 * @property int $current_slide_no
 * @property int $total_slides
 * @property int $completion_status 0 - Not Completed, 1 - Completed
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Learners $learner
 * @property Lessons $lesson
 * @property Sections $section
 * @property User $createdBy
 * @property User $updatedBy
 */
class LearnerActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learner_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'lesson_id', 'section_id', 'current_slide_no', 'total_slides', 'completion_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['learner_id', 'lesson_id', 'section_id', 'current_slide_no', 'total_slides', 'completion_status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Learners::className(), 'targetAttribute' => ['learner_id' => 'id']],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson_id' => 'id']],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sections::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'lesson_id' => 'Lesson ID',
            'section_id' => 'Section ID',
            'current_slide_no' => 'Current Slide No',
            'total_slides' => 'Total Slides',
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
    public function getLearner()
    {
        return $this->hasOne(Learners::className(), ['id' => 'learner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Sections::className(), ['id' => 'section_id']);
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
}
