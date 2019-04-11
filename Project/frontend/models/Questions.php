<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $section_id
 * @property string $question
 * @property int $answer
 * @property string $options
 * @property int $grade
 * @property string $explanation
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LearnerScoring[] $learnerScorings
 * @property Sections $section
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section_id', 'explanation', 'created_at', 'updated_at'], 'required'],
            [['section_id', 'answer', 'grade'], 'integer'],
            [['question', 'options', 'explanation'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sections::className(), 'targetAttribute' => ['section_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Section ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'options' => 'Options',
            'grade' => 'Grade',
            'explanation' => 'Explanation',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerScorings()
    {
        return $this->hasMany(LearnerScoring::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Sections::className(), ['id' => 'section_id']);
    }
}
