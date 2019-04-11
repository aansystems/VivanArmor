<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "lessons_assigned".
 *
 * @property int $id
 * @property int $user_id
 * @property int $lesson_id
 * @property int $status 0-Inactive,1-Active
 */
class LessonsAssigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons_assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lesson_id'], 'required'],
            [['user_id', 'lesson_id', 'status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'lesson_id' => 'Lesson ID',
            'status' => 'Status',
        ];
    }
}
