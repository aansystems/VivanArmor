<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_cso_templates".
 *
 * @property int $id
 * @property string $template_name
 * @property string $fa_icon
 * @property string $template_description
 * @property string $links
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProcessPolicyStatus[] $processPolicyStatuses
 */
class MasterCsoTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_cso_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'template_description', 'status'], 'required'],
            [['template_name', 'template_description', 'links'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fa_icon'], 'string', 'max' => 32],
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
    public function getProcessPolicyStatuses()
    {
        return $this->hasMany(ProcessPolicyStatus::className(), ['policy_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MasterCsoTemplatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterCsoTemplatesQuery(get_called_class());
    }
}
