<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_content_templates".
 *
 * @property int $id
 * @property string $template_name
 * @property string $template_description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Contents[] $contents
 */
class MasterContentTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_content_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'template_description', 'status', 'created_at', 'updated_at'], 'required'],
            [['template_description'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['template_name'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Contents::className(), ['content_type' => 'id']);
    }
}
