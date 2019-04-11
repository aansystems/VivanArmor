<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_hipaa_control".
 *
 * @property int $id
 * @property int $category_id
 * @property string $template_name
 * @property string $fa_icon
 * @property string $template_description
 * @property string $links
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MasterHipaaCategory $category
 */
class MasterHipaaControl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_hipaa_control';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'template_name', 'template_description', 'status'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['template_name', 'template_description', 'links'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['fa_icon'], 'string', 'max' => 32],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterHipaaCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'template_name' => 'Template Name',
            'fa_icon' => 'Fa Icon',
            'template_description' => 'Template Description',
            'links' => 'Links',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MasterHipaaCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return MasterHipaaControlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterHipaaControlQuery(get_called_class());
    }
}
