<?php

namespace frontend\models;
use frontend\models\MatchForm;
use Yii;

/**
 * This is the model class for table "login_answer".
 *
 * @property int $id
 * @property int $question_id
 * @property int $answered_by
 * @property string $answer
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LoginQuestions $question
 * @property User $answeredBy
 */
class LoginAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_answer';
    }

    /**
     * @inheritdoc
     */
    // public $question_id;
    // public $answer;
    // public $answered_by;
   
    public $answer1;
    public $answer2;
    public $answer3;
    public $answer4;
    public $answer5;

    public function rules()
    {
        return [
            [['question_id', 'answered_by','answer','answer1', 'answer2', 'answer3', 'answer4', 'answer5','status', 'created_at', 'updated_at'], 'required'],
            [['question_id', 'answered_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['answer'], 'string', 'max' => 255],
            [['answer1', 'answer2', 'answer3', 'answer4', 'answer5'], 'string', 'length' => [1, 32], 'message' => "password should contain atleast 2 characters."],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoginQuestions::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['answered_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['answered_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'answered_by' => 'Answered By',
            'answer' => 'Answer',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(LoginQuestions::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredBy()
    {
        return $this->hasOne(User::className(), ['id' => 'answered_by']);
    }
}
