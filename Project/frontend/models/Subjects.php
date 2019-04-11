<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property int $id
 * @property string $subject_name
 * @property string $quiz_name
 * @property string $duration
 * @property int $status 0-Inactive, 1-Active
 * @property string $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property TakenTimedQuiz[] $takenTimedQuizzes
 * @property TimedQuiz[] $timedQuizzes
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_name', 'quiz_name', 'duration', 'status', 'created_at', 'created_by'], 'required'],
            [['duration', 'created_at'], 'safe'],
            [['status', 'created_by'], 'integer'],
            [['subject_name', 'quiz_name'], 'string', 'max' => 65],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name' => 'Subject Name',
            'quiz_name' => 'Quiz Name',
            'duration' => 'Duration',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
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
    public function getTakenTimedQuizzes()
    {
        return $this->hasMany(TakenTimedQuiz::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimedQuizzes()
    {
        return $this->hasMany(TimedQuiz::className(), ['subject' => 'id']);
    }
}
