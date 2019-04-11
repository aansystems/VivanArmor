<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "login_questions".
 *
 * @property int $id
 * @property string $question
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LoginAnswer[] $loginAnswers
 */
class LoginQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'login_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'status', 'created_at', 'updated_at'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['question'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoginAnswers()
    {
        return $this->hasMany(LoginAnswer::className(), ['question_id' => 'id']);
    }
}
