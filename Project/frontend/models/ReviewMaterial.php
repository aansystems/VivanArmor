<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review_material".
 *
 * @property int $id
 * @property int $course_id
 * @property int $review_material_type_id
 * @property string $description
 * @property int $description_type 1 - Question(boolean), 2 - Question(MCQ), 3 - Hint, 4 - Writing,5-Video
 * @property string $options
 * @property string $right_answer
 * @property string $explanation
 * @property int $grade
 * @property string $link
 * @property string $created_at
 *
 * @property ReviewMaterialScoring[] $reviewMaterialScorings
 */
class ReviewMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'review_material_type_id', 'description', 'description_type', 'options', 'right_answer', 'explanation', 'grade', 'created_at'], 'required'],
            [['course_id', 'review_material_type_id', 'description_type', 'grade'], 'integer'],
            [['description', 'options', 'explanation', 'link'], 'string'],
            [['created_at'], 'safe'],
            [['right_answer'], 'string', 'max' => 20],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['review_material_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterReviewMaterialType::className(), 'targetAttribute' => ['review_material_type_id' => 'id']],
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
            'review_material_type_id' => 'Review Material Type ID',
            'description' => 'Description',
            'description_type' => 'Description Type',
            'options' => 'Options',
            'right_answer' => 'Right Answer',
            'explanation' => 'Explanation',
            'grade' => 'Grade',
            'link' => 'Link',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterialType()
    {
        return $this->hasOne(MasterReviewMaterialType::className(), ['id' => 'review_material_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterialScorings()
    {
        return $this->hasMany(ReviewMaterialScoring::className(), ['review_material_id' => 'id']);
    }
}
