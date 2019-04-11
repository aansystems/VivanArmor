<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cso_templates".
 *
 * @property int $id
 * @property string $name
 * @property int $master_template_id
 * @property string $file_name
 * @property string $folder_name
 * @property string $created_at
 * @property string $updated_at
 */
class CsoTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cso_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'master_template_id', 'file_name', 'folder_name', 'created_at', 'updated_at'], 'required'],
            [['master_template_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'file_name', 'folder_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'master_template_id' => 'Master Template ID',
            'file_name' => 'File Name',
            'folder_name' => 'Folder Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
