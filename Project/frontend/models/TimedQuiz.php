<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "timed_quiz".
 *
 * @property int $id
 * @property int $subject
 * @property string $question
 * @property string $options
 * @property string $right_answer
 * @property string $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property Subjects $subject0
 */
class TimedQuiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timed_quiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'question', 'options', 'right_answer', 'created_at', 'created_by'], 'required'],
            [['subject', 'created_by'], 'integer'],
            [['options'], 'string'],
            [['created_at'], 'safe'],
            [['question'], 'string', 'max' => 255],
            [['right_answer'], 'string', 'max' => 65],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['subject'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'question' => 'Question',
            'options' => 'Options',
            'right_answer' => 'Right Answer',
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
    public function getSubject0()
    {
        return $this->hasOne(Subjects::className(), ['id' => 'subject']);
    }
}
