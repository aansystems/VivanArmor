<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_doc_templates".
 *
 * @property int $id
 * @property string $template_name
 * @property string $template_description
 * @property string $image_name
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AssignedTemplates[] $assignedTemplates
 */
class MasterDocTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_doc_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'template_description', 'image_name', 'status', 'created_at', 'updated_at'], 'required'],
            [['template_description'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['template_name'], 'string', 'max' => 255],
            [['image_name'], 'string', 'max' => 65],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_name' => 'Template Name',
            'template_description' => 'Template Description',
            'image_name' => 'Image Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTemplates()
    {
        return $this->hasMany(AssignedTemplates::className(), ['master_doc_temp_id' => 'id']);
    }
}
