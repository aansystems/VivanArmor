<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ebooks".
 *
 * @property int $id
 * @property int $course_id
 * @property string $file_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Courses $course
 */
class Ebooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ebooks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'file_name', 'created_at', 'updated_at'], 'required'],
            [['course_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['file_name'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'file_name' => 'File Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }
}
