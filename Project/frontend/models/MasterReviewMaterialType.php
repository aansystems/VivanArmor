<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_review_material_type".
 *
 * @property int $id
 * @property string $review_material_type
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ReviewMaterial[] $reviewMaterials
 */
class MasterReviewMaterialType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_review_material_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['review_material_type', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['review_material_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_material_type' => 'Review Material Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviewMaterials()
    {
        return $this->hasMany(ReviewMaterial::className(), ['review_material_type_id' => 'id']);
    }
}
