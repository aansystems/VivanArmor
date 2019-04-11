<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "taken_timed_quiz".
 *
 * @property int $id
 * @property int $subject_id
 * @property int $learner_user_id
 * @property int $attempt
 * @property string $total_marks_obtained
 * @property string $created_date
 * @property int $created_by
 *
 * @property Subjects $subject
 * @property User $learnerUser
 * @property User $createdBy
 */
class TakenTimedQuiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taken_timed_quiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'learner_user_id', 'attempt', 'created_date', 'created_by'], 'required'],
            [['subject_id', 'learner_user_id', 'attempt', 'created_by'], 'integer'],
            [['created_date'], 'safe'],
            [['total_marks_obtained'], 'string', 'max' => 4],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['learner_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['learner_user_id' => 'id']],
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
            'subject_id' => 'Subject ID',
            'learner_user_id' => 'Learner User ID',
            'attempt' => 'Attempt',
            'total_marks_obtained' => 'Total Marks Obtained',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject_id']);
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
}
