<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "courses_tiles_assigned".
 *
 * @property int $id
 * @property int $user_id
 * @property int $courses_assigned
 * @property int $tiles_assigned
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property User $user
 * @property Courses $coursesAssigned
 * @property User $createdBy
 * @property Tiles $tilesAssigned
 * @property User $updatedBy
 */
class CoursesTilesAssigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses_tiles_assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'courses_assigned', 'tiles_assigned', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['user_id', 'courses_assigned', 'tiles_assigned', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['courses_assigned'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courses_assigned' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['tiles_assigned'], 'exist', 'skipOnError' => true, 'targetClass' => Tiles::className(), 'targetAttribute' => ['tiles_assigned' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'courses_assigned' => 'Courses Assigned',
            'tiles_assigned' => 'Tiles Assigned',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAssigned()
    {
        return $this->hasOne(Courses::className(), ['id' => 'courses_assigned']);
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
    public function getTilesAssigned()
    {
        return $this->hasOne(Tiles::className(), ['id' => 'tiles_assigned']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
