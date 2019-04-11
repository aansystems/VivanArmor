<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "timed_quizes_summary".
 *
 * @property int $id
 * @property int $timed_quiz_question_id
 * @property int $answered_option
 * @property int $taken_timed_quiz_id
 * @property int $learner_user_id
 * @property string $created_at
 * @property int $created_by
 *
 * @property TimedQuiz $timedQuizQuestion
 * @property User $learnerUser
 * @property User $createdBy
 * @property TakenTimedQuiz $takenTimedQuiz
 */
class TimedQuizesSummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timed_quizes_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timed_quiz_question_id', 'answered_option', 'taken_timed_quiz_id', 'learner_user_id', 'created_at', 'created_by'], 'required'],
            [['timed_quiz_question_id', 'answered_option', 'taken_timed_quiz_id', 'learner_user_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['timed_quiz_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => TimedQuiz::className(), 'targetAttribute' => ['timed_quiz_question_id' => 'id']],
            [['learner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['learner_user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['taken_timed_quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => TakenTimedQuiz::className(), 'targetAttribute' => ['taken_timed_quiz_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timed_quiz_question_id' => 'Timed Quiz Question ID',
            'answered_option' => 'Answered Option',
            'taken_timed_quiz_id' => 'Taken Timed Quiz ID',
            'learner_user_id' => 'Learner User ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimedQuizQuestion()
    {
        return $this->hasOne(TimedQuiz::className(), ['id' => 'timed_quiz_question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerUser()
    {
        return $this->hasOne(User::className(), ['id' => 'learner_user_id']);
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
    public function getTakenTimedQuiz()
    {
        return $this->hasOne(TakenTimedQuiz::className(), ['id' => 'taken_timed_quiz_id']);
    }
}
