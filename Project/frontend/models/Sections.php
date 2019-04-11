<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $section_name
 * @property string $folder_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LearnerActivity[] $learnerActivities
 * @property Questions[] $questions
 * @property Lessons $lesson
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lesson_id', 'section_name', 'folder_name', 'created_at', 'updated_at'], 'required'],
            [['lesson_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['section_name', 'folder_name'], 'string', 'max' => 255],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lesson_id' => 'Lesson ID',
            'section_name' => 'Section Name',
            'folder_name' => 'Folder Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerActivities()
    {
        return $this->hasMany(LearnerActivity::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['section_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson_id']);
    }
}
