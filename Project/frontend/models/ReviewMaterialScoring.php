<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review_material_scoring".
 *
 * @property int $id
 * @property int $learner_id
 * @property int $review_material_id
 * @property string $answer
 * @property string $created_at
 * @property int $created_by
 *
 * @property User $learner
 * @property User $createdBy
 * @property ReviewMaterial $reviewMaterial
 */
class ReviewMaterialScoring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review_material_scoring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'review_material_id', 'answer', 'created_at', 'created_by'], 'required'],
            [['learner_id', 'review_material_id', 'created_by'], 'integer'],
            [['answer'], 'string'],
            [['created_at'], 'safe'],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['learner_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['review_material_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReviewMaterial::className(), 'targetAttribute' => ['review_material_id' => 'id']],
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
            'review_material_id' => 'Review Material ID',
            'answer' => 'Answer',
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterial()
    {
        return $this->hasOne(ReviewMaterial::className(), ['id' => 'review_material_id']);
    }
}
