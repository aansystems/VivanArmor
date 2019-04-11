<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "learner_scoring".
 *
 * @property int $id
 * @property int $learner_id
 * @property int $question_id
 * @property string $answer
 * @property int $score
 * @property string $created_at
 * @property int $created_by
 *
 * @property User $learner
 * @property Questions $question
 * @property User $createdBy
 */
class LearnerScoring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learner_scoring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'question_id', 'answer', 'score', 'created_at', 'created_by'], 'required'],
            [['learner_id', 'question_id', 'score', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['answer'], 'string', 'max' => 225],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['learner_id' => 'id']],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::className(), 'targetAttribute' => ['question_id' => 'id']],
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
            'learner_id' => 'Learner ID',
            'question_id' => 'Question ID',
            'answer' => 'Answer',
            'score' => 'Score',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearner()
    {
        return $this->hasOne(User::className(), ['id' => 'learner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Questions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
